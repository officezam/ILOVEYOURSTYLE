@extends('layouts/contentLayoutMaster')

@section('title', 'Contact List')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<!-- Basic Add ContactForm section start -->
<section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
       {{-- <div class="card-header">
          <h4 class="card-title">Add List</h4>
        </div>--}}
        <div class="card-body">
         {{-- @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
         --}}
          <form class="form" action="{{'save-contact-list'}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
            <input name="_token" type="hidden" value="{{ csrf_token() }}"  >
            <input name="created_by_id" type="hidden" value="1"  >
            <input name="compaign_id" type="hidden" value="1"  >

            <div class="row">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Do you want to create a new list or to add to an existing list?</h4>
                </div>
                <div class="card-body">
                  {{--  <p class="card-text mb-0">
                      Do you want to create a new list or to add to an existing list?
                    </p>--}}
                  <div class="demo-inline-spacing">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio1" name="listtype" class="custom-control-input" checked value="newlist" />
                      <label class="custom-control-label" for="customRadio1">Create New List</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio2" name="listtype" class="custom-control-input" value="existlist" />
                      <label class="custom-control-label" for="customRadio2">Add To Existing List</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <!-- Remote Data -->
                <div class="form-group" id="savedlist" style="display: none">
                  <label>Choose Contact List</label>
                  <select class="select2 form-control" name="savedlist" id="savedlistoption">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL" selected>Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                  </select>
                  @error('savedlist')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group" id="compaignlist">
                  <label>Update a campaign with the contacts?</label>
                  <select class="select2 form-control" name="campaign" id="campaign">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL" selected>Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                  </select>
                  @error('campaign')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group" id="choosefile" @if(! $errors->listname)) style="display: none" @endif >
                  <label for="customFile">Choose Stylesheet from computer</label>
                  <div class="custom-file">
                    <input type="file" name="listname" value="" class="custom-file-input" id="customFile" />
                    <label class="custom-file-label" for="customFile">Choose Stylesheet</label>
                  </div>
                  @error('listname')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="card-body">
                <button type="submit" class="btn btn-primary mr-1">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Floating Label Form section end -->
@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/contacts/upload-list-select2.js')) }}"></script>
@endsection