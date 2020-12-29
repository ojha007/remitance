<?php


namespace Modules\Backend\Http\Response;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ReflectionClass;

class ErrorResponse
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
     * @var \Exception
     */
    private $exception;

    /**
     * SuccessResponse constructor.
     * @param $model
     * @param Request $request
     * @param \Exception $exception
     * @param string $event
     * @param null $redirectPath
     */
    public function __construct($model, Request $request, \Exception $exception, $event = 'create', $redirectPath = null)
    {
        $this->model = $model;
        $this->event = $event;
        $this->redirectPath = $redirectPath;
        $this->request = $request;
        $this->exception = $exception;
    }


    public function responseError()
    {

        Log::error($this->exception->getMessage() . '-' . $this->exception->getTraceAsString());
        $model = $this->model instanceof Model ? $this->getName($this->model) : ucwords($this->model);
        $message = [
            'failed' => 'Whoops!' . $model . ' failed to ' . $this->event . ' .'
        ];
        if ($this->request->ajax()) {
            $this->request->session()->flash('failed', $message['failed']);
            return response()->json(['status' => 201]);
        }
        if ($this->redirectPath) {
            return redirect($this->redirectPath)
                ->with($message)
                ->withInput();
        } else {
            return redirect()
                ->back()
                ->with($message)
                ->withInput();
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
