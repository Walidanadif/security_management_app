@extends('layouts.app')

@section('title', 'Mon planning')

@section('content')
<div class="container-fluid p-4">
    <h4>Mon planning de sécurité</h4>
    <div id="calendar" style="min-height:650px;"></div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let calendar = new FullCalendar.Calendar(
        document.getElementById('calendar'),
        {
            initialView: 'timeGridWeek',
            locale: 'fr',
            events: "{{ route('agent.calendrier.events') }}",
            eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },

            eventContent: function(arg) {
              return {
              html: `
            <div class="fc-event-custom">
                <div class="fc-time fw-bold mb-1">
                    ${arg.timeText}
                </div>

                <div class="fc-title fw-semibold">
                    ${arg.event.title}
                </div>

                <div class="fc-address d-flex align-items-start mt-1">
                    <i class="fas fa-map-marker-alt me-2 mt-1"></i>
                    <div class="address-text">
                        ${arg.event.extendedProps.adresse.replace(/\n/g, '<br>')}
                    </div>
                </div>
            </div>
        `
    };
}
        }
    );

    calendar.render();
});
</script>
@endsection

