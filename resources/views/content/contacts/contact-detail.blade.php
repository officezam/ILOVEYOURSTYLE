
@extends('layouts/contentLayoutMaster')

@section('title', 'Contact List')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
{{--<div class="row">
  <div class="col-12">
    <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p>
  </div>
</div>--}}



<!-- Multilingual -->
<section id="multilingual-datatable">
  <div class="row">
    <!-- User Card starts-->
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card user-card">
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
              <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                  <img class="img-fluid rounded" src="http://localhost:8000/images/avatars/7.png" height="104" width="104" alt="User avatar">
                  <div class="d-flex flex-column ml-1">
                    <div class="user-info mb-1">
                      <h4 class="mb-0">{{ $Contacts->first_name.' '. $Contacts->last_name }}</h4>
                      <span class="card-text">{{ $Contacts->email }}</span>
                    </div>
                    <div class="d-flex flex-wrap">
                      <a href="{{ route('update-contact', $Contacts->id) }}" class="btn btn-primary waves-effect waves-float waves-light">Edit</a>
                      <a href="{{ route('delete-contact', $Contacts->id) }}"><button class="btn btn-outline-danger ml-1 waves-effect">Delete</button> </a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
              <div class="user-info-wrapper">
                <div class="d-flex flex-wrap">
                  <div class="user-info-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span class="card-text user-info-title font-weight-bold mb-0">Company: </span>
                  </div>
                  <p class="card-text mb-0"> {{ $Contacts->company_name }}</p>
                </div>
                <div class="d-flex flex-wrap my-50">
                  <div class="user-info-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                  </div>
                  <p class="card-text mb-0">Active</p>
                </div>
                <div class="d-flex flex-wrap my-50">
                  <div class="user-info-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <span class="card-text user-info-title font-weight-bold mb-0">Home Phone</span>
                  </div>
                  <p class="card-text mb-0">{{ $Contacts->home_phone }}</p>
                </div>
                <div class="d-flex flex-wrap my-50">
                  <div class="user-info-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag mr-1"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                    <span class="card-text user-info-title font-weight-bold mb-0">Work Phone</span>
                  </div>
                  <p class="card-text mb-0">{{ $Contacts->work_phone }}</p>
                </div>
                <div class="d-flex flex-wrap">
                  <div class="user-info-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone mr-1"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <span class="card-text user-info-title font-weight-bold mb-0">Mobile Phone</span>
                  </div>
                  <p class="card-text mb-0">{{ $Contacts->mobile_phone }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /User Card Ends-->

  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title"></h4>
          <a href="{{ route('add-contact') }}" class="dt-button create-new btn btn-primary right">Add Contact</a>

        </div>
        <div class="card-datatable">

          <table id="AllList" class="dt-multilingual table">
            <thead>
            <tr>
              <th>Name</th>
              <th>Company</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Home Phone</th>
              <th>Work Phone</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($AllList as $product)
              <tr>
                <td>{{ $product->first_name.' '.$product->last_name  }}</td>
                <td>{{ $product->company_name  }}</td>
                <td>{{  $product->email }}</td>
                <td>{{  $product->mobile_phone }}</td>
                <td>{{ $product->home_phone  }}</td>
                <td>{{ $product->work_phone  }}</td>
                <td>


                  <div class="d-inline-flex">
                    <a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                      <i data-feather='more-vertical'></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="/contacts/contact-detail/{{ $product->id  }}" class="dropdown-item">
                        <i data-feather='book-open'></i> Detail</a>
                      <a href="/contacts/delete-contact/{{ $product->id  }}" class="dropdown-item delete-record">
                        <i data-feather='delete'></i> Delete</a>
                    </div>
                  </div>
                  <a href="/contacts/update-contact/{{ $product->id  }} "class="item-edit">
                    <i data-feather='edit'></i>
                  </a>

                </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>Company</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Home Phone</th>
              <th>Work Phone</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>


{{--
          <table class="dt-multilingual table">
            <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Company</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Home Phone</th>
              <th>Work Phone</th>
              <th>Action</th>
            </tr>
            </thead>
          </table>
--}}
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Multilingual -->
@endsection


@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
{{--  <script src="{{ asset(mix('js/scripts/tables/contact-list.js')) }}"></script>s--}}
@endsection
