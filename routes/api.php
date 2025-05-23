use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\AttachmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes untuk Client
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{client}', [ClientController::class, 'show']);

// API Routes untuk Schedule
Route::get('/schedules', [ScheduleController::class, 'index']);
Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']);

// API Routes untuk Session
Route::get('/sessions', [SessionController::class, 'index']);
Route::get('/sessions/{session}', [SessionController::class, 'show']);

// API Routes untuk Topic
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{topic}', [TopicController::class, 'show']);

// API Routes untuk Attachment
Route::get('/attachments', [AttachmentController::class, 'index']);
Route::get('/attachments/{attachment}', [AttachmentController::class, 'show']); 