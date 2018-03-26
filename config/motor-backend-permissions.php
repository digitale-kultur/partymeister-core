<?php

return [
    'callbacks'   => [
        'name'   => 'partymeister-core::backend/callbacks.callbacks',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'schedules'   => [
        'name'   => 'partymeister-core::backend/schedules.schedules',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'events'      => [
        'name'   => 'partymeister-core::backend/events.events',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'event_types' => [
        'name'   => 'partymeister-core::backend/event_types.event_types',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'guests'      => [
        'name'   => 'partymeister-core::backend/guests.guests',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'visitors'    => [
        'name'   => 'partymeister-core::backend/visitors.visitors',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
];