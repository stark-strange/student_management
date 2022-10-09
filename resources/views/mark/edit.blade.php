{{-- Mark edit modal starts --}}
{{-- <div class="modal fade text-left" id="mark-edit-modal" tabindex="-1"
role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true"> --}}
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Edit Mark </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('mark.update', $mark->id) }}" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <label>Student: </label>
                <fieldset class="form-group">
                    <select class="form-select" id="basicSelect" name="student" required>
                        <option value="">Select Student</option>
                        @foreach ($students as $item)
                            <option value="{{ $item->id }}" {{ $item->name }} @if ($item->id == $mark->student->id) selected @endif>{{ $item->name }}</option>    
                        @endforeach
                    </select>
                </fieldset>

                <label>TERM: </label>
                <fieldset class="form-group">
                    <select class="form-select" id="basicSelect" name="term" required>
                        <option value="">Select Term</option>
                        @foreach ($term as $item)
                            <option value="{{ $item->id }}" {{ $item->name }} @if ($item->id == $mark->term->id) selected @endif>{{ $item->name }}</option>    
                        @endforeach
                    </select>
                </fieldset>

                <label>Mark (Maths): </label>
                <div class="form-group">
                    <input type="number" placeholder="ENTER MATHS MARK"
                        class="form-control" name="mark_maths" value="{{ $mark->maths }}" required>
                </div>

                <label>Mark (Science): </label>
                <div class="form-group">
                    <input type="number" placeholder="ENTER SCIENCE MARK"
                        class="form-control" name="mark_science" value="{{ $mark->science }}" required>
                </div>

                <label>Mark (History): </label>
                <div class="form-group">
                    <input type="number" placeholder="ENTER HISTORY MARK"
                        class="form-control" name="mark_history" value="{{ $mark->history }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1"
                    >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                </button>
            </div>
        </form>
    </div>
</div>
{{-- </div> --}}
{{-- Mark edit modal ends --}}