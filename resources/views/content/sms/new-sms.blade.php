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


      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Message Send to Indvidual Phone</h4>
          </div>
          <div class="card-body">
              <form class="form form-horizontal" action="{{'sms-send'}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}"  >
              <div class="row">
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                      <label for="first-name">Select a Phone</label>
                    </div>
                    <div class="col-sm-9">
                      <select class="select2 form-control" name="ToPhone" id="ToPhone">
                        @foreach ($AllContact as $product)
                          <option value="{{ $product->mobile_phone  }}">{{ $product->first_name.' '.$product->last_name.' '.$product->mobile_phone  }}</option>
                        @endforeach
                      </select>
                      @error('ToPhone')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                      <label for="email-id">Write a Text Please</label>
                    </div>
                    <div class="col-sm-9">
                      <div class="form-label-group mb-0">
                        <p>Write Message here</p>
                        <textarea
                                required
                                data-length="100"
                                class="form-control char-textarea"
                                id="textarea-counter"
                                rows="3"
                                placeholder="Counter"
                                name="sms_text"
                        ></textarea>
                        <label for="textarea-counter">Counter</label>
                      </div>
                      <small class="textarea-counter-value float-right"><span class="char-count">0</span> / 100 </small>
                    </div>
                  </div>
                <div class="col-sm-9 offset-sm-3">
                  <button type="submit" class="btn btn-primary mr-1">Send</button>
                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
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