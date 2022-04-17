<script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
      timer: 5000
    });
</script>

@if ($message = Session::get('success'))
<script>
  Toast.fire({
        icon: 'success',
        title: ' {{$message}}'
      });
</script>

@endif

@if ($message = Session::get('error'))
<script>
  Toast.fire({
        icon: 'error',
        title: ' {{$message}}'
      });
</script>
@endif

@if ($message = Session::get('warning'))
<script>
  Toast.fire({
        icon: 'success',
        title: ' {{$message}}'
      });
</script>
@endif

@if ($message = Session::get('info'))
<script>
  Toast.fire({
        icon: 'success',
        title: ' {{$message}}'
      });
</script>
@endif
