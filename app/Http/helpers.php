<?php
function spanByStatus($status, $withPull = '')
{
//    badge bg-primary btn btn-flat
    switch (strtolower($status)) {
        case 'yes':
        case '1':
            $labelClass = 'bg-success';
            $labelName = 'Active';
            break;
        case 'no';
        case '0':
            $labelClass = 'bg-warning';
            $labelName = 'Inactive';
            break;
        default:
            $labelClass = 'bg-warning';
            $labelName = 'Pending';

    }
    return '<span style="cursor: default;"
        class="badge btn btn-flat  ' . $labelClass . ' ' . ($withPull) . '">'
        . ucfirst($labelName) . '</span>';
}
