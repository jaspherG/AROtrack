@if(count($students) > 0)
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
        <td class="ps-4">{{$requirement->class_year}}</td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->name}}</p>
        </td>
        <td class="text-center">
            <p class="text-xs font-weight-bold mb-0">{{$student->email}}</p>
        </td>
        <td class="text-center">
            <span class="text-secondary text-xs font-weight-bold">{{$student->course}}</span>
        </td>
        <td class="text-center">
            <a href="/student/{{$student->id}}" class="mx-1" data-bs-toggle="tooltip" data-bs-original-title="Edit {{ $student->name}}">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>
            <a href="#" type="button" class="mx-1 add-requirement" data-bs-toggle="tooltip" data-bs-original-title="Add Requirement to {{ $student->name}}"  data-id="{{ $student->id}}">
                <i class="fas fa-edit text-secondary"></i>
            </a>
            <a href="#" type="button" class="delete-student" data-bs-toggle="tooltip" data-bs-original-title="Delete {{ $student->name}}" data-id="{{ $student}}">
                <i class="text-danger fas fa-trash text-secondary"></i>
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