<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class ActivityController extends Controller
{
    public function activity_index(Request $request)
    {
        $pageTitle = 'Activity Log';
        $login = auth()->user()->toArray();
        $activePage = 'activity';
        $user_permissions = session('combined_permissions', []);
        $user_branch = [];

        if (!empty($login)) {
            if ($login['user_role_id'] != 1) {
                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds);
                $userBranchIds = array_filter($userBranchIds);

                if (!empty($userBranchIds)) {
                    $user_branch = Branch::get_users_branch($userBranchIds);
                } else {
                    $user_branch = [];
                }
            } else {
                $user_branch = Branch::get_all_branch();
            }
        }

        return view('activity/activity_master', compact(
            'pageTitle',
            'login',
            'activePage',
            'user_branch',
            'user_permissions'
        ));
    }

    public function activity_list(Request $request)
    {
        $login = auth()->user()->toArray();

        $rules = [
            'search' => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];

        $messages = [
            'search.string' => 'Search query must be a valid string.',
            'per_page.integer' => 'Items per page must be a valid integer.',
            'per_page.min' => 'Items per page must be at least 1.',
            'page.integer' => 'Page number must be a valid integer.',
            'page.min' => 'Page number must be at least 1.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0],
                'errors' => $validator->errors(),
            ]);
        }

        $searchQuery = $request->input('search', '');
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);

        // Debug logging
        \Log::info('Activity search request', [
            'search' => $searchQuery,
            'per_page' => $perPage,
            'page' => $page
        ]);

        // Get activities with pagination
        $activities = ActivityLog::getActivitiesWithPagination($perPage, $searchQuery);

        // Format the data for response
        $formattedActivities = $activities->getCollection()->map(function ($activity) {
            return [
                'activity_id' => $activity->activity_id,
                'order_id' => $activity->order_id,
                'order_number' => $activity->order ? $activity->order->order_number : 'N/A',
                'order_qr_code' => $activity->order ? $activity->order->order_qr_code : 'N/A',
                'order_activity' => $activity->order_activity,
                'transaction_id' => $activity->order_trans_id,
                'user_name' => $activity->user ? ($activity->user->user_name ?? $activity->user->name) : 'N/A',
                'created_at' => $activity->created_at->format('d-m-Y H:i:s'),
                'updated_at' => $activity->updated_at->format('d-m-Y H:i:s'),
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'Activity log fetched successfully!',
            'data' => $formattedActivities,
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $activities->total(),
            'recordsFiltered' => $activities->total(),
            'per_page' => $perPage,
            'current_page' => $page,
            'total_pages' => $activities->lastPage()
        ]);
    }
} 