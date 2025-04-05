import dayGridPlugin from '@fullcalendar/daygrid';
import FullCalendar from '@fullcalendar/react';

export default function MeetingCalendar() {
    const events = [{ title: 'Meeting', start: new Date() }];

    const eventContent = (eventInfo) => {
        return (
            <>
                <b>{eventInfo.timeText}</b>
                <i>{eventInfo.event.title}</i>
            </>
        );
    };

    return (
        <div>
            <h1>календарь заседаний</h1>
            <FullCalendar
                plugins={[dayGridPlugin]}
                initialView="dayGridMonth"
                weekends={false}
                events={events}
                eventContent={eventContent}
            />
        </div>
    );
}
