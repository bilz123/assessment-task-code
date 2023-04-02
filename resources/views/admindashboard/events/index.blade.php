@extends('layouts.app')
@section('title', 'Events')
@section('content')
 <div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Events</h3>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{ route('events.create') }}" class="btn btn-primary" ajax-modal>
                        <em class="icon ni ni-plus"></em>
                        <span>Add New Event</span></a>
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner position-relative card-tools-toggle">
                <table id="events-dt" class="table nowrap nk-tb-list nk-tb-ulist dataTable no-footer" width="100%">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th><span class="sub-text">#</span></th>
                            <th><span class="sub-text">Event Name</span></th>
                            <th><span class="sub-text">Start Date</span></th>
                            <th><span class="sub-text">End Date</span></th>
                            <th><span class="sub-text">Action</span></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-scripts')
<script>

 var table = $('#events-dt').DataTable({
      processing: true,
      serverSide: true,
      scrollX: false,
      autoWidth: true,
      ordering: false,
      ajax: "{{ route('events-dt') }}",

      columns: [
          {data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false},
          {data: 'event_name', name: 'event_name'},
          {data: 'start_date', name: 'start_date'},
          {data: 'end_date', name: 'end_date'},
          {data: 'action', name: 'action'},
      ]
    
  });
</script>
@endpush