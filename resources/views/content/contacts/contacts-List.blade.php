
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
  <script src="{{ asset(mix('js/scripts/contacts/all-list.js')) }}"></script>
  {{--<script src="{{ asset(mix('js/scripts/contacts/contact-list.js')) }}"></script>--}}
@endsection
