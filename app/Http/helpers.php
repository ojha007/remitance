<?php
function spanByStatus($status, $withPull = ''): string
{

    switch (strtolower($status)) {
        case 'yes':
        case '1':
            $labelClass = 'bg-green';
            $labelName = 'Active';
            break;
        case 'no';
        case '0':
            $labelClass = 'bg-yellow';
            $labelName = 'Inactive';
            break;
        case 'pending':
            $labelClass = 'bg-yellow';
            $labelName = 'Pending';
            break;
        default:
            $labelClass = 'bg-red';
            $labelName = $status;

    }
    return '<span style="cursor: default;"
        class="label btn btn-flat  ' . $labelClass . ' ' . ($withPull) . '">'
        . ucfirst($labelName) . '</span>';
}
