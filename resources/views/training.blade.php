@extends('layouts.static-app')
@section('content')
<div class="container">
    <div class="col-md-12 row" id="meet">

    </div>
</div>
@endsection
@section('script')
<script src="{{ env('MEETAPP_URL') }}"></script>
<script>

window.onload = (evt) => {
  const domain = "{{ env('MEETAPP_DOMAIN') }}"
  const options = {
  roomName: "{{ $training->title }}",
  width: 1024,
  height: 590,
  parentNode: document.querySelector('#meet'),
  interfaceConfigOverwrite: {
      SHOW_JITSI_WATERMARK: false,
      APP_NAME: "{{ env('APP_NAME') }}",
      NATIVE_APP_NAME: "{{ env('APP_NAME') }}",
      PROVIDER_NAME: "{{ env('APP_PROVIDER') }}"
      }
  }

  const vidApi = new JitsiMeetExternalAPI(domain, options)
  vidApi.executeCommand('toggleAudio', [])
  vidApi.executeCommand('toggleVideo', [])
  vidApi.executeCommand('displayName', '{{ Auth::user()->name }}')
  vidApi.on('readyToClose', (evt) => {
    window.location.href = 'home/trainings/{{ $training->id }}/view'
  })
}
</script>
@endsection
