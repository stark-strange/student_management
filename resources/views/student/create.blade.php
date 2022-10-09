{{-- Student add modal starts --}}
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Add Student </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('student.store') }}" method="post" id="createForm">
            @csrf
            <div class="modal-body">
                <label>Name: </label>
                <div class="form-group">
                    <input type="text" placeholder="ENTER NAME"
                        class="form-control" name="name" required>
                </div>
                <label>Age: </label>
                <div class="form-group">
                    <input type="number" placeholder="ENTER AGE"
                        class="form-control" name="age" required>
                </div>
                <label>Gender: </label>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="flexRadioDefault1" name="gender" value="m" required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="flexRadioDefault2" name="gender" value="f" required>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="flexRadioDefault3" name="gender" value="o" required>
                    <label class="form-check-label" for="flexRadioDefault3">
                        Others
                    </label>
                </div><br>

                <label>Reporting Teacher: </label>
                <fieldset class="form-group">
                    <select class="form-select" id="basicSelect" name="teacher" required>
                        <option value="">Select Teacher</option>
                        @foreach ($teachers as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>    
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
                <button type="submit" class="btn btn-primary ml-1 save_button">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- student add modal ends --}}