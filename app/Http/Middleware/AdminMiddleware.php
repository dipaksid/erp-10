<?php

namespace App\Http\Middleware;

use Closure;
use Doctrine\Inflector\InflectorFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::check() && $request->segment(1) === null) {
            return redirect('/home');
        }

        if (!$this->hasPermission($request)) {
            if ($request->segment(1) === "home") {
                $loginDate = $request->session()->get('login_date') ?? now();
                abort(411, "Unauthorized access. Last login date: {$loginDate}");
            } elseif ($request->segment(1) === "") {
                return redirect('/login');
            } else {
                abort(401, "Unauthorized access. Last login date: {$request->session()->get('login_date')}");
            }
        }

        // Check if the request has at least one segment before using $request->segment(1)
        if ($request->segment(1) !== null) {
            if (!$this->hasPermission($request)) {
                if ($request->segment(1) === "home") {
                    $loginDate = $request->session()->get('login_date') ?? now();
                    abort(411, "Unauthorized access. Last login date: {$loginDate}");
                } else {
                    abort(401, "Unauthorized access. Last login date: {$request->session()->get('login_date')}");
                }
            }
        }

        view()->share('request', $request);
        return $next($request);
    }

    protected function hasPermission(Request $request)
    {
        $module = $this->getModule($request);
        if (!$module) {
            return false;
        }

        return Auth::user()->hasPermissionTo($module);
    }

    protected function getModule(Request $request)
    {
        $requestSegment = $request->segment(1);
        $singularSegment = $this->getSingularSegment($requestSegment);
        //dd($singularSegment);
        if ($singularSegment === "") {
            return false;
        } else {
            switch ($singularSegment){
                case 'area':
                case 'areas':
                    $classname = "App\\Models\\Area";
                    $method = "getModule";
                    break;
                case 'customer-group':
                    $classname = "App\\Models\\CustomerGroup";
                    $method = "getModule";
                    break;
                case 'company_setting':
                    $classname = "App\\Models\\CompanySetting";
                    $method = "getModule";
                    break;
                case 'system_setting':
                    $classname = "App\\Models\\SystemSetting";
                    $method = "getModule";
                    break;
                case 'customer-service':
                    $classname = "App\\Models\\CustomerService";
                    $method = "getModule";
                    break;
                case 'customer-pwspg-app':
                    $classname = "App\\Models\\CustomerService";
                    $method = "getModule";
                    break;
                case 'totalpayapp':
                    $classname = "App\\Models\\CustomerTotalPayApp";
                    $method = "getModule";
                    break;
                case 'supplier':
                    $classname = "App\\Models\\Supplier";
                    $method = "getModule";
                    break;
                case 'leaveformpdf':
                    $classname = "App\\Models\\LeaveForm";
                    $method = "getModule";
                    break;
                case 'evaluation-form':
                    $classname = "App\\Models\\EvaluationForm";
                    $method = "getModule";
                    break;
                default:
                    $classname = "App\\Models\\" . ucfirst($singularSegment);
                    $method = "getModule";
                    break;
            }

            return $classname::$method($request);
        }
    }

    protected function getSingularSegment($pluralSegment)
    {
        $singularMapping = [
            'salesinvoices' => 'salesinvoice',
            'customercategories' => 'customercategory',
            'stockcategories' => 'stockcategory',
            // Add other plural/singular mappings as needed
        ];

        if (isset($singularMapping[$pluralSegment])) {
            return $singularMapping[$pluralSegment];
        }

        return $this->str_singular($pluralSegment);
    }
    function str_singular($pluralWord)
    {
        $inflector = InflectorFactory::create()->build();

        return $inflector->singularize($pluralWord);
    }
}
