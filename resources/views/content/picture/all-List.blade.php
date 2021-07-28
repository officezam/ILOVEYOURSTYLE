
@extends('layouts/contentLayoutMaster')

@section('title', 'Picture List')

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
            <a href="{{ route('add-picture') }}" class="dt-button create-new btn btn-primary right">Send Picture Message</a>

          </div>
          <div class="card-datatable">

            <table id="AllList" class="dt-multilingual table">
              <thead>
              <tr>
                <th>Picture From</th>
                <th>Picture To</th>
                <th>Picture </th>
                <th>Picture Text </th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($AllList as $product)
                <tr>
                  <td>{{ $product->picture_from  }}</td>
                  <td>{{ $product->picture_to  }}</td>
                  <td>
                    <a href="{{ URL::asset($product->picture_link)  }}" target="_blank">View Image</a>

                  </td>
                  <td>{{ $product->picture_text  }}</td>
                  <td>{{ $product->status  }}</td>
                  <td>

                    <div class="d-inline-flex">
                      <a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown"><i data-feather='edit'></i></a>

                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="/picture/delete-picture/{{ $product->id  }}" class="dropdown-item delete-record">Delete</a>
                      </div>
                    </div>

          </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>Picture From</th>
            <th>Picture To</th>
            <th>Picture </th>
            <th>Picture Text </th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </tfoot>
          </table>
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
@endsection
