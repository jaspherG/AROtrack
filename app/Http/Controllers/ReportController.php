<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;
use App\Models\Service;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\RequirementDocument;
use App\Models\RequirementRemark;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportService(Request $request) 
    {
        $data = $this->studentReportDataExcel($request);
        return response()->json(['data'=> $data->tableData, 'title'=> $data->title, 'year'=> $data->year]);
    }

    public function generateReport(Request $request) {
        $user = Auth::user();

        $data = new \stdClass();
        $data->title = '';
        $data->tableData = [];
        $data->year = '';
        if(!isset($request->id)){
            abort(404);
        } else if($request->id === 'admin-service-report') {
            $data = $this->studentReportData($request);
        }

        $title =  $data->title;
        $tableData =  $data->tableData;
        $description =  "School Year: ".$data->year;
        return view('print.report', compact('tableData', 'title', 'description', 'user'))->with('_page', 'print report');
    }
    
    // for export excel
    private function studentReportDataExcel($request){
        $service_data = Service::with(['requirements.user_student', 'requirements.requirement_documents.document']);

        $year = 'All';
        if(!empty($request->academic_year)){
            $year = $request->academic_year;
        }
        if(!empty($request->service_id)){
            $service_data->where('id', $request->service_id);
        }
        $service_data->with(['requirements' => function($q) use ($request) {
            if(!empty($request->academic_year)){
                $q->where('academic_year', $request->academic_year);
            }
            if(!empty($request->class_year)){
                $q->where('class_year', $request->class_year);
            }
            if(!empty($request->program_id)){
                $q->where('program_id', $request->program_id);
            }
            if(!empty($request->remarks)){
                $q->where('status', $request->remarks);
            }
            if(!empty($request->service_id) && $request->service_id == 1){
                $q->where('is_new_student', 0);
            }
        }]);
        $service_data = $service_data->get();

        if (!$service_data) {
            return response()->json(['message' => 'Service not found'], 404);
        } 

        $serviceData = collect();

        foreach ($service_data as $service) {
            $formattedRequirements = $this->formattedRequirements($service->requirements);
            $serviceData = $serviceData->merge($formattedRequirements);
        }

        // Prepare headers
        $headerRow = ['No.', 'Student No.', 'Student Name', 'Program', 'Class Year', 'Remarks', 'Status'];

        $tableData = [$headerRow];
        $index = 1; // Initialize index for numbering

        foreach ($serviceData as $requirement) {
            $requirement->formatted_status = $requirement->is_new_student == 0 ? ucfirst($requirement->service->service_name) : 'Old Student';
            $rowData = [
                $index,
                $requirement->user_student->student_number,
                $requirement->user_student->name,
                $requirement->program->program_name,  // Assuming there's a 'program' property
                $requirement->class_year,
                $requirement->status,  // Assuming there's a 'remarks' property
                $requirement->formatted_status,  // Assuming there's a 'remarks' property
            ];

            $tableData[] = $rowData;
            $index++;  // Increment index
        }

        $remarks = '';
        if(isset($request->remarks) && $request->remarks == 'Completed') {
            $remarks = ' with Completed Requirements';
        } else if(isset($request->remarks) && $request->remarks == 'Deficiency') {
            $remarks = ' with Deficiency Requirements';
        } 
        $status = '';
        if(isset($request->service_id)) {
            $status = ucfirst($service[0]->service_name);
        } 
        // else {
        //     $status = ' Requirements';
        // } 

        $c_program = '';
        if(isset($request->program_id)) {
            $programData = Program::findOrFail($request->program_id);
            $c_program = " ".$programData->program_name.' Students';
        } 
        // else {
        //     $c_program = ' All Students';
        // }

        $c_year = '';
        if(isset($request->class_year)) {
            $c_year = " ".$request->class_year;
        } 

        $data = new \stdClass();

        $data->tableData = $tableData;
        $data->title = "List of ".$status.$c_year.$c_program.$remarks. ' Requirements';
        $data->year = $year;

        return $data;

    }

    
    // for print
    private function studentReportData($request) {
        $service = Service::with(['requirements.user_student', 'requirements.requirement_documents.document']);
    
        $year = 'All';
        if(!empty($request->academic_year)){
            $year = $request->academic_year;
        }
        if(!empty($request->service_id)){
            $service->where('id', $request->service_id);
        }
        $service->with(['requirements' => function($q) use ($request) {
            if(!empty($request->academic_year)){
                $q->where('academic_year', $request->academic_year);
            }
            if(!empty($request->class_year)){
                $q->where('class_year', $request->class_year);
            }
            if(!empty($request->program_id)){
                $q->where('program_id', $request->program_id);
            }
            if(!empty($request->remarks)){
                $q->where('status', $request->remarks);
            }
            if(!empty($request->service_id) && $request->service_id == 1){
                $q->where('is_new_student', 0);
            }
        }]);
        $service = $service->get();

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        } 

        $remarks = '';
        if(isset($request->remarks) && $request->remarks == 'Completed') {
            $remarks = ' with Completed Requirements';
        } else if(isset($request->remarks) && $request->remarks == 'Deficiency') {
            $remarks = ' with Deficiency Requirements';
        }
        $status = '';
        if(isset($request->service_id)) {
            $status = ucfirst($service[0]->service_name);
        } 
        // else {
        //     $status = ' Requirements';
        // } 

       
        $c_program = '';
        if(isset($request->program_id)) {
            $programData = Program::findOrFail($request->program_id);
            $c_program = " ".$programData->program_name.' Students';
        } 
        // else {
        //     $c_program = ' All Students';
        // }

        $c_year = '';
        if(isset($request->class_year)) {
            $c_year = " ".$request->class_year;
        } 

        $programString = '';
        $program = Program::where('id', $request->program_id)->first();


        $data = new \stdClass();

        $serviceData = collect();

        foreach ($service as $serviced) {
            $formattedRequirements = $this->formattedRequirements($serviced->requirements);
            $serviceData = $serviceData->merge($formattedRequirements);
        }



        $data->tableData = $serviceData;
        $data->title = "List of ".$status.$c_year. $c_program.$remarks.'';
        $data->year = $year;

        return $data;
    }

    private function formattedRequirements(&$requirements) {
        foreach ($requirements as $requirement) {
            $completedDocumentsCount = 0;
            $deficientDocumentsCount = 0;
            
            foreach ($requirement->requirement_documents as $document) {
                if ($document->status == 1) {
                    $completedDocumentsCount++;
                } else if ($document->status == 0) {
                    $deficientDocumentsCount++;
                }
            }

            $requirement->formatted_status = $requirement->is_new_student == 0 ? ucfirst($requirement->service->service_name) : 'Old Student';
    
            $requirement->deficientDocumentsCount = $deficientDocumentsCount;
            $requirement->completedDocumentsCount = $completedDocumentsCount;
        }
    
        return $requirements;
    }

}
