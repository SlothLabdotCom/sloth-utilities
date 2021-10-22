<?php

namespace Slothlabdotcom\SlothUtilities\Http\Controllers;

class GitController extends Controller
{
    private $password = '123456';

    public function index($password)
    {
        if($password == $this->password)
        {
            return view('SlothUtilities::git.index');
        }
        return abort('404');
    }

    public function gitPull($password)
    {
        if ($password == $this->password) {
            chdir(base_path());
            $result = "";
            $data = [];
            $data[] = 'Username => ' . shell_exec('whoami');
            $data[] = 'Path => ' . getcwd();
            $data[] = 'Git pull (if null then successful) => ' . shell_exec('git pull');
            $data[] = 'Composer => </br>' . shell_exec('composer install --no-interaction --no-dev --prefer-dist');
            $data[] = 'Migrate => </br>' . shell_exec('php artisan migrate --force');
            foreach ($data as $element) {
                $result .= "<pre style='font-size:15px;'>" . $this->convert($element) . "</pre>";
            }
            $result .= "<a href='". route('git.index', $this->password) ."'><button>Go Back</button></a>";
            echo $result;
            die();
        }
        return abort('404');
    }

    public function migrateFresh($password)
    {
        if ($password == $this->password) {
            chdir(base_path());
            $result = "";
            $data = [];
            $data[] = 'Username => ' . shell_exec('whoami');
            $data[] = 'Path => ' . getcwd();
            $data[] = 'Migrate => </br>' . shell_exec('php artisan migrate:refresh --force --seed');
            foreach ($data as $element) {
                $result .= "<pre style='font-size:15px;'>" . $this->convert($element) . "</pre>";
            }
            $result .= "<a href='" . route('git.index', $this->password) . "'><button>Go Back</button></a>";
            echo $result;
            die();
        }
        return abort('404');
    }

    public function seedDB($password)
    {
        if ($password == $this->password) {
            chdir(base_path());
            $data = [];
            $result = "";
            $data[] = 'Username => ' . shell_exec('whoami');
            $data[] = 'Path => ' . getcwd();
            $data[] = 'Seed => </br>' . shell_exec('php artisan db:seed --force');
            foreach($data as $element) {
                $result .= "<pre style='font-size:15px;'>" . $this->convert($element) . "</pre>";
            }
            $result .= "<a href='" . route('git.index', $this->password) . "'><button>Go Back</button></a>";
            echo $result;
            die();
        }
        return abort('404');
    }

    public function dumpAutoload($password)
    {
        if ($password == $this->password) {
            chdir(base_path());
            $result = "";
            $data = [];
            $data[] = 'Username => ' . shell_exec('whoami');
            $data[] = 'Path => ' . getcwd();
            $data[] = 'Composer => </br>' . shell_exec('composer dump-autoload --no-interaction');
            foreach ($data as $element) {
                $result .= "<pre style='font-size:15px;'>" . $this->convert($element) . "</pre>";
            }
            $result .= "<a href='" . route('git.index', $this->password) . "'><button>Go Back</button></a>";
            echo $result;
            die();
        }
        return abort('404');
    }

    public function phpOptimize($password)
    {
        if ($password == $this->password) {
            chdir(base_path());
            $result = "";
            $data = [];
            $data[] = 'Username => ' . shell_exec('whoami');
            $data[] = 'Path => ' . getcwd();
            $data[] = 'Artisan => </br>' . shell_exec('php artisan optimize') . shell_exec('php artisan cache:clear') . shell_exec('php artisan view:clear');
            foreach ($data as $element) {
                $result .= "<pre style='font-size:15px;'>" . $this->convert($element) . "</pre>";
            }
            $result .= "<a href='" . route('git.index', $this->password) . "'><button>Go Back</button></a>";
            echo $result;
            die();
        }
        return abort('404');
    }

    private function convert($output)
    {
        $output = str_replace('[31m', '<span style="color: red;"><b>', $output);
        $output = str_replace('[32m', '<span style="color: green;"><b>', $output);
        $output = str_replace('[33m', '<span style="color: orange;"><b>', $output);
        $output = str_replace('[39m', '</b></span>', $output);
        return $output;

    }
}
