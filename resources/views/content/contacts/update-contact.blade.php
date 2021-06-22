@extends('layouts/contentLayoutMaster')

@section('title', 'Update Contact')

@section('content')

<!-- Basic Add ContactForm section start -->
<section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Update Contact</h4>
        </div>
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
          <form class="form" action="{{ route('update-save')}}" method="post" accept-charset="UTF-8" >
            <input name="_token" type="hidden" value="{{ csrf_token() }}"  >
            <input name="id" type="hidden" value="{{ $ContactData->id }}"  >
            <input name="compaign_id" type="hidden" value="1"  >
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="first-name-column">First Name</label>
                  <input
                    type="text"
                    id="first-name-column"
                    class="form-control"
                    placeholder="First Name"
                    name="first_name"
                    value="{{  $ContactData->first_name  }}"
                  />
                  @error('first_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="last-name-column">Last Name</label>
                  <input
                    type="text"
                    id="last-name-column"
                    class="form-control"
                    placeholder="Last Name"
                    name="last_name"
                    value="{{ $ContactData->last_name }}"
                  />
                  @error('last_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="city-column">Home Phone</label>
                  <input type="text" id="city-column" class="form-control" placeholder="Home Phone" name="home_phone" value="{{ $ContactData->home_phone }}" />
                  @error('home_phone')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="country-floating">Mobile Phone</label>
                  <input
                    type="text"
                    id="country-floating"
                    class="form-control"
                    name="mobile_phone"
                    placeholder="Mobile Phone"
                    value="{{ $ContactData->mobile_phone }}"
                  />
                  @error('mobile_phone')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="country-floating">Work Phone</label>
                  <input
                    type="text"
                    id="country-floating"
                    class="form-control"
                    name="work_phone"
                    placeholder="Work Phone"
                    value="{{  $ContactData->work_phone }}"
                  />
                  @error('work_phone')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="company-column">Company Name</label>
                  <input
                    type="text"
                    id="company-column"
                    class="form-control"
                    name="company_name"
                    placeholder="Company Name"
                    value="{{ $ContactData->company_name }}"
                  />
                  @error('company_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="email-id-column">Email</label>
                  <input
                    type="email"
                    id="email-id-column"
                    class="form-control"
                    name="email"
                    placeholder="Email"
                    value="{{  $ContactData->email  }}"
                  />
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary mr-1">Update</button>
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
