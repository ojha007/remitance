<?php


namespace Modules\Backend\Http\Response;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use ReflectionClass;

class SuccessResponse
{
    /**
     * @var string
     */
    private $event;

    private $model;
    /**
     * @var int
     */

    private $status;
    /**
     * @var null
     */
    private $redirectPath;
    /**
     * @var bool
     */
    private $is_ajax;
    /**
     * @var bool
     */
    private $request;

    /**
     * SuccessResponse constructor.
     * @param $model
     * @param Request $request
     * @param string $event
     * @param null $redirectPath
     * @param int $status
     */
    public function __construct($model, Request $request, $event = 'created', $redirectPath = null, $status = 200)
    {
        $this->model = $model;
        $this->event = $event;
        $this->status = $status;
        $this->redirectPath = $redirectPath;
        $this->request = $request;
    }


    public function responseOk()
    {

        $model = $this->model instanceof Model ? $this->getName($this->model) : ucwords($this->model);
        $message = [
            'success' => $model . ' ' . $this->event . ' successfully !'
        ];
        if ($this->request->ajax()) {
            $this->request->session()->flash('success', $message['success']);
            return response()->json(['status' => 201]);
        }
        if ($this->redirectPath) {
            return redirect($this->redirectPath)
                ->with($message);
        } else {
            return redirect()
                ->back()
                ->with($message);
        }
    }

    protected function getName($model)
    {
        try {
            return (new ReflectionClass($model))->getShortName();
        } catch (\ReflectionException $e) {
            return get_class($model);
        }

    }
}
