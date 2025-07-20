<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\CacheInspector;

class VisitorStatsController extends Controller
{
    public function index(Request $request)
    {
        $pattern = CacheInspector::statsPattern();
        $stats = CacheInspector::list($pattern);

        if ($request->has('inertia') && $request->input('inertia') == '0') {
            return response()->json(['stats' => $stats]);
        }

        // Optional: als Inertia-View für Blade/Adminpanel
        // return inertia('Admin/VisitorStats', ['stats' => $stats]);
    }

    public function destroy(Request $request, $key)
{
    $key = $request->input('key');
    if (!$key) {
        return response()->json(['success' => false, 'error' => 'Kein Key angegeben!'], 400);
    }
    \App\Helpers\CacheInspector::delete($key);
    return response()->json(['success' => true]);
}

    // AJAX Bulk Delete
    public function bulkDelete(Request $request)
    {
         $count = \App\Helpers\CacheInspector::deleteAllVisitorStats();
    return response()->json([
        'success' => true,
        'deleted' => $count,
        'message' => "$count Besucherstatistik-Einträge wurden gelöscht.",
    ]);
    }
}
