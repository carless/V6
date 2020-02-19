<?php
namespace Cesi\Core\libs\Controllers;

use Cesi\Core\app\App\Helpers\CesiCoreHelper;
use Cesi\Core\app\Models\CoreEmailTmpl;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class CoreBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Enviar un email
     *
     * @param array $config
     *      $config['to']       => Email destinatario
     *      $config['data']     => array de datos con las keys => valores
     *      $config['template'] => Nombre (slug) del template
     * @return bool
     */
    public static function sendEmail(array $config = [])
    {
        $driver     = CesiCoreHelper::getConfiguracion('smtp_driver');      // smtp
        $host       = CesiCoreHelper::getConfiguracion('smtp_host');        // smtp.servidoresdns.es
        $port       = CesiCoreHelper::getConfiguracion('smtp_port');        // 465
        $from_email = CesiCoreHelper::getConfiguracion('smtp_from_email');
        $from_name  = CesiCoreHelper::getConfiguracion('smtp_from_name');
        $encryption = CesiCoreHelper::getConfiguracion('smtp_encryption');  // ssl
        $smtpauth   = CesiCoreHelper::getConfiguracion('smtp_smtpauth');    // S/N
        $username   = CesiCoreHelper::getConfiguracion('smtp_username');    // 'info@9diari.com';
        $password   = CesiCoreHelper::getConfiguracion('smtp_password');

        // Esto no sirve para NADA
        Config::set('mail.driver', $driver);
        Config::set('mail.host', $host);
        Config::set('mail.port', $port);
        Config::set('mail.from', ['address' => $from_email, 'name' => $from_name]);
        Config::set('mail.encryption', $encryption );
        Config::set('mail.username', $username );
        Config::set('mail.password', $password );

        try {
            // create new mailer with new settings
            $transport = (new \Swift_SmtpTransport($host, $port))
                ->setUsername($username)
                ->setPassword($password)
                ->setEncryption($encryption);

            Mail::setSwiftMailer(new \Swift_Mailer($transport));

            $email_to = $config['to'];
            $data = $config['data'];

            $slug = 'default_template';
            if (isset($config['slug'])) {
                $slug = $config['slug'];
            }
            $itemTemplate = CoreEmailTmpl::where('slug', $slug)->first();

            $html = $itemTemplate->content;
            foreach ($data as $key => $val) {
                $html = str_replace('[' . $key . ']', $val, $html);
                $itemTemplate->subject = str_replace('[' . $key . ']', $val, $itemTemplate->subject);
            }
            $subject = $itemTemplate->subject;
            $html = str_replace('[subject]', $subject, $html);

            $attachments = isset($config['attachments']) ? $config['attachments'] : array();

            Mail::send($itemTemplate->theme, ['content' => $html, 'from_name' => $from_name], function ($message) use ($email_to, $subject, $itemTemplate, $attachments) {
                $message->priority(1);
                $message->to($email_to);

                // El From no puede ser diferente del configurado
                /*
                if($itemTemplate->from_name) {
                    $message->from($itemTemplate->from_email, $itemTemplate->from_name);
                } else {
                    $message->from($itemTemplate->from_email);
                }
                */

                if ($itemTemplate->cc_email) {
                    $message->cc($itemTemplate->cc_email);
                }

                if (count($attachments)) {
                    foreach ($attachments as $attachment) {
                        $message->attach($attachment);
                    }
                }

                $message->subject($subject);
            });

        } catch (Exception $exception) {
            echo "error " . $exception->getMessage() . "\n<br/>";
            echo "";
            echo "getCode(): " . $exception->getCode();
            echo "";
            echo "__toString(): " . $exception->__toString();
            die();
            return false;
        }
        return true;
    }
}
