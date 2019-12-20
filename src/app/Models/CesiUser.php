<?php
namespace Cesi\Core\app\Models;

use App\User;
use Cesi\Core\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Cesi\Core\libs\Models\Traits\InheritsRelationsFromParentModel;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Cesi\Core\CesiCrudTrait;

class CesiUser extends User
{
    use HasRoles;
    use Notifiable;
    use InheritsRelationsFromParentModel;
    use CesiCrudTrait;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
