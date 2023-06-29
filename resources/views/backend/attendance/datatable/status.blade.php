
<div class="switch-toggle switch-3 switch-candy">
    <input class="absent" id="absent{{$employee->id}}" name="attend_status{{$employee->id}}" value="Absent" type="radio" @if($employee->status == "Absent") checked="checked" @else checked="checked" @endif>
    <label for="absent{{$employee->id}}">Absent</label>

    <input class="present" id="present{{$employee->id}}" name="attend_status{{$employee->id}}" value="Present" type="radio" @if($employee->status == "Present") checked="checked" @endif>
    <label for="present{{$employee->id}}">Present</label>

    <input class="leave" id="leave{{$employee->id}}" name="attend_status{{$employee->id}}" value="Leave" type="radio" @if($employee->status == "Leave") checked="checked" @endif>
    <label for="leave{{$employee->id}}">Leave</label>
    <a></a>
</div>
