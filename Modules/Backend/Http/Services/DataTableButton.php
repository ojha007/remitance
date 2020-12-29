<?php


namespace Modules\Backend\Http\Services;


class DataTableButton
{
    public function editButtonModal($value, $modal_name)
    {
        return '<button data-toggle="modal" title="EDIT" data-target="#' . $modal_name . '"
            value="' . $value . '" class="btn btn-primary edit-button btn-flat btn-sm">
            <i class="fa fa-edit "></i></button>';
    }

    public function viewButton($route, $value)
    {
        return '<a class="btn btn-default btn-sm btn-flat" data-container="body"
                   title="View"   href="' . route($route, $value) . '">
                   <i class="fa fa-eye "></i></a>&nbsp;';
    }

    public function deleteButton($route, $value)
    {
        return '<form method="POST" action="' . route($route, $value) . '"
                     onsubmit="return confirm(\'Are you sure you want to delete?\')" style="display: inline;">
                      <input type="hidden"  name="_token" value="' . csrf_token() . '">
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger btn-sm btn-flat" data-container="body"
                      title="Delete" data-placement="bottom" data-tooltip="tooltip"
                     role="button" type="submit">
                     <i class="fa fa-times"></i></button></form>';
    }

    public function editButton($route, $value)
    {
        return '<a class="btn btn-primary btn-sm btn-flat" data-container="body"
                   title="Edit"   href="' . route($route, $value) . '">
                     <i class="fa fa-edit "></i></a>';
    }

}
