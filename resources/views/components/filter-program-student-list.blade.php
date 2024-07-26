@if(isset($students) && count($students) > 0)
    @foreach($students as $key => $student)
    <tr>
      <td class="ps-4">
            <p class="text-xs font-weight-bold mb-0">{{$key+1}}</p>
        </td>
        <td>
            <div>
                <a data-fslightbox="student-list" href="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}">
                    <img src="{{(!empty($student->image) ? '/images/avatars/'.$student->image : '/images/user.jpg' )}}" class="avatar avatar-sm me-3">
                </a>
            </div>
        </td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->student_number}}</p>
        </td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->name}}</p>
        </td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->lrn_number}}</p>
        </td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->class_year}}</p>
        </td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->email}}</p>
        </td>
        <td class="text-center">
            <span class="text-secondary text-xs font-weight-bold">{{$student->phone_number}}</span>
        </td>
        <td class="text-center">
            <span class="text-secondary text-xs font-weight-bold">{{$student->address}}</span>
        </td>
        
        <td class="text-center">
            <a href="javascript:void(0)" class="mx-3 view-requirement" data-id="{{$student}}" data-bs-toggle="tooltip" data-bs-original-title="View Requirements">
                <i class="fas fa-receipt text-secondary"></i>
            </a>
        </td>
    </tr>
    @endforeach
@else
  <tr>
      <td col-span="4">No records found</td>
  </tr>
@endif

<script src="/assets/vendor/fslightbox-basic-3.4.1/fslightbox.js"></script>