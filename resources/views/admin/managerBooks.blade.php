@extends('masterAdmin')
@section('content')

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>tiêu đề</th>
      <th>giá</th>
      <th>tác giả</th>
      <th>thể loại</th>
      <th>#</th>
    </tr>
  </thead>


</table>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      destroy: true,
      data: @json($books),
      "columns": [{
          "data": "title"
        },
        {
          "data": "price"
        },
        {
          "data": "tac_gia"
        },
        {
          "data": "loai_sach"
        },
        {
          "render": function(data, type, row, meta) {
            if (!row.is_delete) {
              return '<a href="/books/edit/' + row.id + '">Edit</a>||<a href="/books/delete/' + row.id + '">Delete</a>'
            } else
            return 'Đã Xóa |<a href="/books/restore/' + row.id + '">Khôi phục</a>'
          }
        }
      ]
    });
  });
</script>
@endsection