<?php
namespace Cesi\Core\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cesi\Core\app\Models\CoreNotifications;
use Illuminate\Support\Facades\Auth;

class CoreNotificationController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxNotifications()
    {
        /*
        * get user id
        */
        $userId = Auth::user()->id;

        /*
         * where conditions to get count
         */
        $where = ['user_id' => $userId, 'is_read' => 0];
        /*
         * get unread count
         */
        $getUnreadNotificationCount = $this->getNotifications($where, 'count');
        /*
         * get top 5 notifications
         */
        $getNotifications = $this->getNotifications($where, 'get', $limit = 5);

        $passArray = array();
        // $passArray['userid']    = $userId;
        $passArray['count']     = $getUnreadNotificationCount;
        $passArray['view']      = view('cesi::inc.notifications')
            ->with('notifications', $getNotifications)
            ->with('unreadNotificationCount', $getUnreadNotificationCount)
            ->render();

        return response()->json($passArray);
    }

    /**
     * @param $where
     * @param string $type
     * @param null $limit
     *
     * @return  [type] [description]
     */
    private function getNotifications($where, $type = 'count', $limit = null)
    {
        $query = CoreNotifications::query();
        foreach ($where as $k => $v) {
            $query = $query->where($k, '=', $v);
        }
        if ($limit) {
            $query = $query->take($limit);
        }
        $query = $query->where('user_id', auth()->user()->id);
        $query = $query->orderBy('created_at', 'desc');

        $count = $query->$type();

        return $count;
    }
}
