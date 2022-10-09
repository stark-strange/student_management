{{-- Student edit modal starts --}}
{{-- <div class="modal fade text-left" id="student-edit-modal" tabindex="-1"
role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true"> --}}
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Edit Student </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('student.update', $student->id) }}" method="post" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <label>Name: </label>
                <div class="form-group">
                    <input type="text" placeholder="ENTER NAME"
                        class="form-control" name="name" value="{{ $student->name }}" required>
                </div>
                <label>Age: </label>
                <div class="form-group">
                    <input type="number" placeholder="ENTER AGE"
                        class="form-control" name="age" value="{{ $student->age }}" required>
                </div>
                <label>Gender: </label>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="flexRadioDefault1" name="gender" value="m" @if ($student->gender == 'm') checked @endif required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="flexRadioDefault2" name="gender" value="f" @if ($student->gender == 'f') checked @endif required>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="flexRadioDefault3" name="gender" value="o" @if ($student->gender == 'o') checked @endif required>
                    <label class="form-check-label" for="flexRadioDefault3">
                        Others
                    </label>
                </div><br>

                <label>Reporting Teacher: </label>
                <fieldset class="form-group">
                    <select class="form-select" id="basicSelect" name="teacher">
                        <option value="">Select Teacher</option>
                        @foreach ($teachers as $item)
                            <option value="{{ $item->id}}" @if ($item->id == $student->teacher->id) selected @endif>{{ $item->name }}</option>    
                        @endforeach
                    </select>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                </button>
            </div>
        </form>
    </div>
</div>
{{-- </div> --}}
{{-- student edit modal ends --}}