    <div class="col-lg-6">
        <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Category:</label>
            <select class="form-control category" name="category" id="category">
                <option value="">Select Category</option>
                @foreach($categorylist as $key=>$value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Cab Model:</label>
            <select class="form-control cabmodel" id="cabmodel" name="cabmodel">
                        <option value="">Select Option</option>

            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Plate/Vechile Reg No.: <span class="cabplateno"></span></label>

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Cab Body Number: <span class="cabbodyno"></span></label>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Driver Name:</label>
            <select class="form-control driver" name="driver">
                        <option value="">Select Driver</option>
                        @foreach($driverlist as $key=>$value)
                            <option value="{{$value->id}}">{{$value->firstname.' '.$value->lastname.'/ Mobile Number : '.$value->mobile}}</option>
                        @endforeach

            </select>

        </div>
    </div>
