<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Announcement;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        return view('notifications.index', ['notifications' => $notifications]);
    }

    public function create($userID)
    {

        return view('notifications.create', ['userID' => $userID]);
    }

    public function store(Request $request, $userID)
    {
        $valid = $request ->validate([
            'notificationText' => 'required|string|max:255',
        ]);

        $notification = Notification::create([
            'notificationText' => $valid['notificationText'],
            'sentFrom' => auth()->user()->id,
            'userID' => $userID,
            'cancelled' => 1,
        ]);

        $notification->save();

        return to_route('notifications.index')-> with('success', 'Notification Sent Successfully !');
    }

    public function destroy($notificationID)
    {
        $notification = Notification::findOrFail($notificationID);
        $notification->delete();
        
        return to_route('notifications.index') -> with('success', 'Notification Deleted Successfully !');
    }

    public function showAnnouncementForm($courseID)
    {
        return view('notificationsViews.showAnnouncementForm', ['courseID' => $courseID]);
    }

    public function storeAnnouncement(Request $request, $courseID)
    {
        $valid = $request -> validate([
            'announcementText' => 'required|string|max:255',
        ]);

        $announcement = Announcement::create([
            'announcementText' => $valid['announcementText'],
            'courseID' => $courseID,
        ]);

        $announcement->save();

        return to_route('courses.assignedCourses') -> with('success', 'Announcement Sent Successfully !');;

    }

}
