<?php


namespace Modules\Backend\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{

    protected $repository;
    protected $notification_drop_menu_count = 15;
    protected $viewPath = 'backend::partial.notifications.';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getNotifications()
    {
        $notifications = $this->getAllNotifications()
            ->limit($this->notification_drop_menu_count)
            ->get();
        return view($this->viewPath, compact('notifications'));
    }

    private function getAllNotifications(): \Illuminate\Database\Query\Builder
    {
        return DB::table('notifications')
            ->select('id', 'data', 'read_at')
            ->where('notifiable_id', auth()->id())
            ->orderBy('created_at', 'desc');
    }

    public function getNotificationCount(): int
    {
        return $this->getAllNotifications()
            ->whereNull('read_at')
            ->count();
    }

    public function markAsRead($id): string
    {
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        return true;
    }

    public function markAllAsRead(): string
    {
        $notifications = $this->getAllNotifications()->whereNull('read_at')->get();
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        return true;
    }

    public function index()
    {
        $notifications = $this->getAllNotifications()->paginate();
//        dd($notifications);
        return view($this->viewPath . 'index', compact('notifications'));
    }

}
