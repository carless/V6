<?php
namespace Cesi\Core\app\Http\Controllers;

use Cesi\Core\app\Models\CoreDashboard;
use Cesi\Core\app\Models\CoreDashboardItem;

class AdminController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(cesi_middleware());
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $this->data['title'] = trans('cesi::core.dashboard.title'); // set the page title

        $dashboardId = 1;
        $positions = [
            'top'   => null,
            'left'  => null,
            'right' => null,
            'center'=> null,
            'bottom'=> null,
        ];

        $this->data['model'] = CoreDashboard::where('id', '=', $dashboardId)->first();
        $this->data['positions'] = array();

        foreach ($positions as $key => $position) {
            $positions[$key] = CoreDashboardItem::where('dashboard_id', '=', $dashboardId)
                ->where('area', '=', $key )
                ->orderBy('sorting', 'asc')
                ->get()
            ;
        }

        $this->data['positions'] = $positions;

        return view('cesi::dashboard', $this->data);
    }

    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(cesi_url('dashboard'));
    }
}
