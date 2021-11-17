<?php

namespace Slothlabdotcom\SlothUtilities\Http\Controllers;

class UtilitiesController extends Controller
{
    private $password;

    private $ext;

    private $count;

    private $total_results;

    private $patterns;

    private $FileNames = array(
        'Probably an OpenFlashChart library demo file that has known input ' . 'validation error (CVE-2009-4140)' => 'ofc_upload_image.php',
        'Probably an R57 shell' => 'r57.php',
        'Probably a C99 shell' => 'c99.php',
        'Probably a C100 shell' => 'c100.php',
        'PhpInfo() file? It is advisable to remove such file, as it could reveal too
                            much info to potential attackers' => 'phpinfo.php',
        'PerlInfo() file? It is advisable to remove such file, as it could reveal too
                            much info to potential attackers' => 'perlinfo.php',
    );

    private $Patterns = array(
        array(
            'preg_replace\s*\(\s*[\"\']\s*(\W)(?-s).*\1[imsxADSUXJu\s]*e[imsxADSUXJu\s]*[\"\'].*\)', // [0] = RegEx search pattern
            'PHP: preg_replace Eval', // [1] = Name / Title
            'Detected preg_replace function that evaluates (executes) matched code. ' . 'This means if PHP code is passed it will be executed.', // [2] = description
            'Part example code from http://sucuri.net/malware/backdoor-phppreg_replaceeval',
        ), // [3] = More Information link
        array(
            'c999*sh_surl',
            'Backdoor: PHP:C99',
            'Detected the "C99 Shell"? Backdoor that allows attackers to manage (and ' . 'reinfect) your website remotely. It is often used as part of a ' . 'compromise to maintain access to the hacked sites.',
            'http://sucuri.net/malware/backdoor-phpc99045',
        ),
        array(
            'preg_match\s*\(\s*\"\s*/\s*bot\s*/\s*\"',
            'Backdoor: PHP:R57',
            'Detected the "R57 Shell"? Backdoor that allows attackers to access, modify and ' . 'reinfect your site. It is often hidden in the filesystem and hard to ' . 'find without access to the server or logs.',
            'http://sucuri.net/malware/backdoor-phpr5701',
        ),
        array(
            'eval[\s/\*\#]*\(stripslashes[\s/\*\#]*\([\s/\*\#]*\$_(REQUEST|POST|GET)\s*\[\s*\\\s*[\'\"]\s*asc\s*\\\s*[\'\"]',
            'Backdoor: PHP:GENERIC',
            'Detected a generic backdoor that allows attackers to upload files, delete ' . 'files, access, modify and/or reinfect your site. It is often hidden ' . 'in the filesystem and hard to find without access to the server or ' . 'logs. It also includes uploadify scripts and similars that offer ' . 'upload options without security. ',
            'http://sucuri.net/malware/backdoor-phpgeneric07',
        ),
        array('https?\S{1,63}\.ru',
            'Russian URL',
            'Detected a .RU domain link, as there are many attacks leading the innocent visitors to .RU pages. Maybe it\'s valid link, but leave it to you to check this out.',
        ),
        array(
            'preg_replace\s*\(\s*[\"\'\”]\s*/\s*\.\s*\*\s*/\s*e\s*[\"\'\”]\s*,\s*[\"\'\”]\s*\\x65\\x76\\x61\\x6c',
            'Backdoor: PHP:Filesman:02',
            'Detected the “Filesman Shell”? Backdoor that allows attackers to access, modify ' . 'and reinfect your site. It is often hidden in the filesystem and hard ' . 'to find without access to the server or logs.',
            'http://sucuri.net/malware/backdoor-phpfilesman02',
        ),
        array(
            '(include|require)(_once)*\s*[\"\'][\w\W\s/\*]*php://input[\w\W\s/\*]*[\"\']',
            'PHP:\input include',
            'Detected the method of reading input through PHP protocol handler in ' . 'include/require statements.',
        ),
        array(
            'data:;base64',
            'data:;base64 include',
            'Detected the method of executing base64 data in include.',
        ),
        array(
            'RewriteCond\s*%\{HTTP_REFERER\}',
            '.HTACCESS RewriteCond-Referer',
            'Your .htaccess file has a conditional redirection based on "HTTP Referer".' . 'This means it redirects according to site/url from where your visitors ' . 'came to your site. Such technique has been used for unwanted redirections ' . 'after coming from Google or other search engines, so check this directive carefully.',
        ),
        array(
            'jquery.min.php',
            'Fake jQuery Malware',
            'This file is infected with the Fake jQuery Malware. Removing the malware is not enough. Make sure your CMS and all its third-party components are up-to-date. All unused stuff should be ruthlessly deleted from server. Some of the compromised websites had malicious WordPress admin users with names like: backup, dpr19, loginfelix. Some of them had been created during past attacks though.',
        ),
        array(
            'GIF89a.*[\r\n]*.*<\?php',
            'PHP file desguised as GIF image',
            'Detected a PHP file that was most probably uploaded as an image via webform that loosely only checks file headers.',
        ),
        array(
            '\$ip[\w\W\s/\*]*=[\w\W\s/\*]*getenv\(["\']REMOTE_ADDR["\']\);[\w\W\s/\*]*[\r\n]\$message',
            'Probably malicious PHP script that "calls home"',
            'Detected script variations often used to inform the attackers about found vulnerable website.',
        ),
        array(
            '(?:(?:base64_decode|str_rot13)[\s\/\*\w\W\(]*){2,};',
            'Multiple encoded, most probably obfuscated code found',
            'This pattern could be used in highly encoded, malicious code hidden under ' . 'a loop of code obfuscation function calls. In most cases the decoded ' . 'hacker code goes through an eval call to execute it. This pattern is ' . 'also often used for legitimate purposes, e.g. storing configuration ' . 'information or serialised object data. ',
        ),
        array(
            '<\s*iframe',
            'IFRAME Element',
            'Found IFRAME element in code. It\'s mostly benevolent, but often used ' . 'for bad stuff, so please check if it\'s a valid code.',
        ),
        array(
            'strrev[\s/\*\#]*\([\s/\*\#]*[\'"]\s*tressa\s*[\'"]\s*\)',
            'Reversed string "assert"',
            'Assert function name is being hidden behind strrev().',
        ),
        array(
            'is_writable[\s/\*\#]*\([\s/\*\#]*getcwd',
            'Is the current DIR Writable?',
            'This could be harmless, but used in some malware',
        ),
        array('(?:\\\\x[0-9A-Fa-f]{1,2}|\\\\[0-7]{1,3}){2,}',
            'At least two characters in hexadecimal or octal notation',
            'Found at least two characters in hexadecimal or octal notation. It '
            . 'doesn\'t mean it is malicious, but it could be code hidding behind '
            . 'such notation.'),
        array(
            '\$_F\s*=\s*__FILE__\s*;\s*\$_X\s*=',
            'SourceCop encoded code',
            'Found the SourceCop encoded code. It is often used for malicious code
                                hidding, so go and check the code with some online SourceCop decoders',
        ),
        array(
            '(?:passthru|shell_exec|proc_|popen)[\w\W\s/\*]*\([\s/\*\#\'\"\w\W\-\_]*(?:\$_GET|\$_POST|\$_REQUEST)',
            'Shell command execution from POST/GET variables',
            'Found direct shell command execution getting variables from POST/GET,
                                which is highly dangerous security flaw or a part of malicious webrootkit',
        ),
        array('\$\w[\w\W\s/\*]*=[\w\W\s/\*]*`.*`',
            'PHP execution operator: backticks (``)',
            'PHP execution operator found. Note that these are not single-quotes!
                        PHP will attempt to execute the contents of the backticks as a shell
                        command, which might indicate a part of a web rootkit'),
        array(
            'fsockopen\s*\(\s*[ \'\"](?:localhost|127\.0\.0\.1)[ \'\"]',
            'Opening socket to localhost',
            'Found code opening socket to localhost, it\'s worth investigating more',
        ),
        array(
            'fsockopen\s*\(.*,\s*[ \'\"](?:25|587|465|475|2525)[ \'\"]',
            'Opening socket to known SMTP ports, possible SPAM script',
            'Found opening socket to known SMTP ports, possible SPAM script',
        ),
        array(
            '(?:readfile|popen)\s*\(\s*[ \'\"]*\s*(?:file|http[s]*|ftp[s]*|php|zlib|data|glob|phar|ssh2|rar|ogg|expect|\$POST|\$GET|\$REQUEST)',
            'Reading streams or superglobal variables with fopen wrappers present',
            'Found functions reading data from streams/wrappers - please analyze the code',
        ),
        array(
            'array_(?:diff_ukey|diff_uassoc|intersect_uassoc|udiff_uassoc|udiff_assoc|uintersect_assoc|uintersect_uassoc)\s*\(.*(?:\$_REQUEST|\$_POST|\$_GET).*;',
            'Callback function comming from REQUEST/POST/GET variable possible',
            'Found possible local execution enabling-script receiving data from POST or GET requests',
        ),
        array(
            '^(((.*)(=|;)(\s*)?)|((@|\s)*))extract\s*\(',
            'Extract Function',
            'PHP extract function found. Extract creates variables from an array (eg $_POST, $_GET or $_REQUEST). It can be legit, but if there is some strange code execution like $extracted_variable_1($extracted_variable_2) it should be malicious.',
        ),
        array(
            '^(((.*)(=|;)(\s*)?)|((@|\s)*))(include|require)(_once)?\s*\(?("|\')https?://',
            'Remote Include',
            'Include or require which includes a remote file. It should be malicious, and vulnerable as well.',
        ),
        array(
            '\\\\x([abcdef0-9]{2}){3,}',
            'Hex Encoded String',
            'Code which is hex encoded. It can be legit, but not a usual thing. Malicious users can hide their functions in hex encoded expressions.',
        ),
    );

    public function __construct()
    {
        $this->password = config('ziplock.token');
    }

    public function index($password)
    {
        if ($password == $this->password) {
            return view('SlothUtilities::utilities.index');
        }
        return abort('404');
    }

    public function check($password)
    {
        if ($password == $this->password) {
            return view('SlothUtilities::utilities.check');
        }
        return abort('404');
    }

    public function scanChoice($password)
    {
        if ($password == $this->password) {
            return view('SlothUtilities::utilities.malwarechoice');
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
            $result .= "<a href='" . route('utilities.index', $this->password) . "'><button>Go Back</button></a>";
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
            foreach ($data as $element) {
                $result .= "<pre style='font-size:15px;'>" . $this->convert($element) . "</pre>";
            }
            $result .= "<a href='" . route('utilities.index', $this->password) . "'><button>Go Back</button></a>";
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
            $result .= "<a href='" . route('utilities.index', $this->password) . "'><button>Go Back</button></a>";
            echo $result;
            die();
        }
        return abort('404');
    }

    public function scan($type, $password)
    {
        @set_time_limit(0);
        ini_set('max_execution_time', -1); //300 Seconds = 5 Minutes
        ini_set('memory_limit', '2048M');

        if ($password == $this->password) {
            $fileExt = config('ziplock.file-extensions');
            $ignoreDirs = config('ziplock.ignored-dirs');
            $directory = config('ziplock.scan-dir');
            $scanstrings = config('ziplock.additional-strings');

            if ($ignoreDirs[0] == '|') {
                $ignoreDirs = ltrim($ignoreDirs, $ignoreDirs[0]);
            }

            if (substr($ignoreDirs, -1) == '|') {
                $ignoreDirs = substr($ignoreDirs, 0, -1);
            }

            if ($directory[0] == '|') {
                $directory = ltrim($directory, $directory[0]);
            }

            if (substr($directory, -1) == '|') {
                $directory = substr($directory, 0, -1);
            }

            if ($scanstrings != '') {

                if ($scanstrings[0] == '|') {
                    $scanstrings = ltrim($scanstrings, $scanstrings[0]);
                }

                if (substr($scanstrings, -1) == '|') {
                    $scanstrings = substr($scanstrings, 0, -1);
                }
            }

            if ($type == "normal" || $type == "deep") {
                $this->count = 0;
                $this->total_results = 0;

                $Strings = 'r0nin|m0rtix|iskorpitx|upl0ad|r57shell|c99shell|shellbot|phpshell|void\.ru|phpremoteview|directmail|bash_history|cwings|vandal|bitchx|eggdrop|guardservices|psybnc|dalnet|undernet|vulnscan|spymeta|raslan58|Webshell|str_rot13|FilesMan|FilesTools|Web Shell|bckdrprm|hackmeplz|wrgggthhd|WSOsetcookie|Hmei7|Inbox Mass Mailer|HackTeam|Hackeado|Janissaries|Miyachung|ccteam|Adminer|OOO000000|$GLOBALS|findsysfolder|makeret.ru|c0d3d by|C0de For|Perl Auto Rooter Perl Script|create_function|b374k|Web Shell by boff|Web Shell by oRb|devilzShell|Shell by Mawar_Hitam|N3tshell|Storm7Shell|Locus7Shell|private Shell by m4rco|w4ck1ng shell|blackhat Shell|FaTaLisTiCz_Fx Fx29Sh|th3w1tch Shell|Goog1e_analistRCBot|Antihutan|Attijari|ByroeNet|cpftpcrack|KAdot|MulCiShell|PHPJackal|POSTpe80|SRCrew|Safe0ver|SimShell|Storm7|Surrogafier|TuR334Vl|UberCracker|Vrs-hCk|Cyb3rDevils|DxShell|DataCha0s|Forever2008|InsideTeam|ItsmYarD|aKpuMPiN|Xnuxer|cgitelnet|ShellHook|Perlovga|Mirccrack|CookStealer|Bypassshell|r00t3r|zerocnbct|Ylyshell|egyspider|evilc0der|violaoeucc0101|iTSecTeam|putr4XtReme|aZRaiL|cbLorD|91.239.15.61|_YM82iAN|XXRANDOMXX|_POST..n13e558|envir0nn@yahoo.com|$bogel|c999sh_surl|xVebaPURjEzLc|AQSP|ANTIPIDERSIA|uzanc|xadpritox|blackboy007|nacomb13|Devilzc0de|8a4bf282852bf4c49e17f0951f645e72|k2ll33d|tsxpwkpqbk|HackerBooty|JE8wMDBPME8wMD1mb3BlbigkT09PME8w|Rawckerhead|sPMQhNQMR9XM05Cvsbg1DTE5vRJiEnn|UnixCrew|HolaKo|4xI0DHgMAmwFstDDeTdg26|fb0979fa651bb915d186ac0fddcd1bc6|fb621f5060b9f65acf8eb4232e3024140dea2b34|xunzhaocangjingkong|123321|WwW.7jyewu.Cn|zbazszez64z_zdeczodze|nr9Sb1ehwpGJoIkcy5LEUxtRVxEzGglYpr5xIy|HaniXavi|k_i@outlook.com|hanikadi0@gmail.com|naruto@localhost.com|JSUlJSUlJbEk9J3NldF90aW1lX2xpbWl0Jzs|Dz93hR3fWlPVRtrH2txMf+DrmGvyq4tsaa|IRCBot|Locus7s|c100 Shell|Project x2300|Captain Crunch Team|Shadow & Preddy|w4ck1ng|milw0rm|Rootshell.c|Snailsor,FuYu,BloodSword,Cnqing|ASPXSpy|Iranian Hackers|Hossein Asgary|SimAttacker|simorgh-ev|BuqX@HotMail.Com|GrayHatz Hacking|Kacak FSO|grayhatz.org|TurkGuvenligi|r57.biz|evalinfect|1dt.w0lf|http://ghc.ru|evilc0der.com';
                $DeepScanStrings = 'zlib_decode|zlib_encode|gzget|gzpassthru|lzw_decompress|passthru|shell_exec|proc_|popen|proc_open|edoced_46esab';

                if ($scanstrings != '') {
                    $Strings .= '|' . $scanstrings;
                }

                if ($type == "deep") {
                    @$this->patterns = array_merge($this->Patterns, explode('|', $Strings), explode('|', $DeepScanStrings));
                } else {
                    @$this->patterns = array_merge($this->Patterns, explode('|', $Strings));
                }

                $this->ext = explode('|', $fileExt);

                $before = microtime(true);
                echo '
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta name="robots" content="noindex" />
                        <title>Sloth Utilities</title>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
                            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                        <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.11.2/r-2.2.9/datatables.min.css"/>
                        <link rel=" stylesheet" href="'.public_path() .'/sloth-assets/css/admin.css">
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                    </script>
                    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.11.2/r-2.2.9/datatables.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
                    </script>
                    <script src="'.public_path() .'/sloth-assets/js/admin.js"></script>
                    <script>
                    $(document).ready(function() {

                        $(\'#dt-basic\').dataTable( {
                            "responsive": true,
                            "language": {
                                "paginate": {
                                "previous": \'<i class="fa fa-angle-left"></i>\',
                                "next": \'<i class="fa fa-angle-right"></i>\'
                                }
                            }
                        } );
                    } );
                    </script>
                    </head>

                    <body>
                        <section>
                            <div class="container-fluid p-5">
                                <div class="text-center mt-5 mb-5">
                                    <img src="https://sloth-lab.com/ss-02.png" style="width:180px" />
                                </div>
                ';
                $this->get_filelist($directory);
                $after = microtime(true);
                $totaltime = mb_substr(($after - $before), 0, 4);
                echo 'The scan found <strong>', $this->total_results, ' suspicious malware code spots</strong> in <u>', $this->count, ' different files</u>!<br/>';
                echo 'Scanning time was <strong>' . $totaltime . ' seconds</strong> <br>';

                echo '</div>
                    </section>


                </body>

                </html>
                ';

            }

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

    private function HumanReadableFilesize($file)
    {
        $size = filesize($file);
        $mod = 1024;
        $units = explode(' ', 'B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }
        return round($size, 2) . ' ' . $units[$i];
    }

    private function get_filelist($dir)
    {
        global $ignoreDirs;
        $ignoreArr = explode('|', $ignoreDirs);

        $path = $dir;
        $toResolve = array(
            $dir,
        );
        while ($toResolve) {
            $thisDir = array_pop($toResolve);
            if (@$dirContent = scandir($thisDir)) {
                foreach ($dirContent as $content) {
                    if (!in_array($content, $ignoreArr)) {
                        $thisFile = "$thisDir/$content";
                        if (is_file(@$thisFile)) {
                            $this->scan_file($thisFile);
                        } else {
                            $toResolve[] = $thisFile;
                        }
                    }
                }
            }
        }

    }

    private function calculate_line_number($offset, $file_content)
    {
        @list($first_part) = str_split($file_content, $offset);
        $line_nr = strlen($first_part) - strlen(str_replace("\n", "", $first_part)) + 1;
        return $line_nr;
    }

    private function scan_file($path)
    {
        $dateformat = "d F Y - H:i:s ";

        if (in_array(pathinfo($path, PATHINFO_EXTENSION), $this->ext) && filesize($path)) {

            if ($malic_file_descr = array_search(pathinfo($path, PATHINFO_BASENAME), $this->FileNames)) {
                echo '<tr>
                        <td>' . basename($path) . '</td>
                        <td>Suspicious FileName</td>
                        <td> - </td>
                        <td>' . date($dateformat, filemtime($path)) . '</td>
                        <td>' . substr(sprintf('%o', fileperms($path)), -4) . '</td>
                        <td>
                        <button data-target="#details-' . pathinfo($path, PATHINFO_FILENAME) . '" data-toggle="modal" class="btn btn-flat btn-success"><i class="fas fa-file-alt"></i> Details</button>
                        </td>

    <div class="modal fade" id="details-' . pathinfo($path, PATHINFO_FILENAME) . '" role="dialog" tabindex="-1" aria-labelledby="details-' . pathinfo($path, PATHINFO_FILENAME) . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Details</h4>
                    </div>

                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">

                                                            <label class="col-sm-3 control-label"><i class="fas fa-file-alt"></i> File Name: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="name" class="form-control" value="' . basename($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-flag"></i> Path:</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . $path . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-lock"></i> Permission: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . substr(sprintf('%o', fileperms($path)), -4) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-key"></i> Last Accessed: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . date($dateformat, fileatime($path)) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fas fa-pen-square"></i> Last Modified: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . date($dateformat, filemtime($path)) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-folder"></i> File Size: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . $this->HumanReadableFilesize($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-cog"></i> MD5 Hash: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . md5_file($path) . '" readonly /><br />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-flat btn-primary" type="button">Close</button>
                                    </div>
                            </div>
                        </div>
                </div>
                        </tr>';
            }

            if (!($content = file_get_contents($path))) {
                $error = 'Could not check ' . $path;
            } else {

                foreach ($this->patterns as $pattern) {
                    if (is_array($pattern)) {
                        preg_match_all('#' . $pattern[0] . '#isS', $content, $found, PREG_OFFSET_CAPTURE);
                    } else {
                        preg_match_all('#' . $pattern . '#isS', $content, $found, PREG_OFFSET_CAPTURE);
                    }
                    $all_results = $found[0];
                    $results_count = count($all_results);
                    $this->total_results += $results_count;
                    if (!empty($all_results)) {
                        $this->count++;
                        if (is_array($pattern)) {
                            echo '<tr>
                            <td>' . basename($path) . '</td>
                            <td><font color="red"><i>' . $pattern[1] . '</i></font></td>
                            <td>' . $results_count . '</td>
                            <td>' . date($dateformat, filemtime($path)) . '</td>
                            <td>' . substr(sprintf('%o', fileperms($path)), -4) . '</td>
                            <td>
                            <button data-target="#details-' . $this->count . '" data-toggle="modal" class="btn btn-flat btn-success"><i class="fas fa-file-alt"></i> Details</button>
                            </td>

    <div id="" class="zoom-anim-dialog modal-block modal-header-color modal-block-danger mfp-hide">
    <div class="modal fade" id="details-' . $this->count . '" role="dialog" tabindex="-1" aria-labelledby="details-' . $this->count . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Details</h4>
                    </div>

                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">

                                                            <label class="col-sm-3 control-label"><i class="fas fa-file-alt"></i> File Name: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="name" class="form-control" value="' . basename($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-flag"></i> Path:</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . $path . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-lock"></i> Permission: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . substr(sprintf('%o', fileperms($path)), -4) . '" readonly />
                                                                ';
                            $permissions = substr(sprintf('%o', fileperms($path)), -4);
                            if (intval($permissions) == 777) {
                                $permissions = '<font color="orange">(Please note: The file have full access permissions)</font><br /><br />';
                            } else {
                                echo '<br />';
                            }
                            echo '
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-key"></i> Last Accessed: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . date($dateformat, fileatime($path)) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fas fa-pen-square"></i> Last Modified: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . date($dateformat, filemtime($path)) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-folder"></i> File Size: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . $this->HumanReadableFilesize($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-cog"></i> MD5 Hash: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . md5_file($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-folder"></i> Threat Description: </label>
                                                            <div class="col-sm-9">
                                                                <textarea type="text" class="form-control" rows="7" readonly />' . $pattern[2] . '</textarea><br />
                                                            </div>

                                                            ';
                            foreach ($all_results as $match) {
                                echo '<span class="offset">Line #: ', $this->calculate_line_number($match[1], $content), '</span>', "<pre>... " . htmlentities(substr($content, $match[1], 200), ENT_QUOTES) . " ...</pre>\n";
                            }
                            echo '
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-flat btn-primary" type="button">Close</button>
                                    </div>
                            </div>
                        </div>
                </div>
                            ';
                        } else {
                            echo '<tr>
                            <td>' . basename($path) . '</td>
                            <td><font color="red"><i>' . $pattern . '</i></font></td>
                            <td>' . $results_count . '</td>
                            <td>' . date($dateformat, filemtime($path)) . '</td>
                            <td>' . substr(sprintf('%o', fileperms($path)), -4) . '</td>
                            <td>
                            <button data-target="#details-' . $this->count . '" data-toggle="modal" class="btn btn-flat btn-success"><i class="fas fa-file-alt"></i> Details</button>
                            </td>

    <div id="" class="zoom-anim-dialog modal-block modal-header-color modal-block-danger mfp-hide">
    <div class="modal fade" id="details-' . $this->count . '" role="dialog" tabindex="-1" aria-labelledby="details-' . $this->count . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Details</h4>
                    </div>

                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">

                                                            <label class="col-sm-3 control-label"><i class="fas fa-file-alt"></i> File Name: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="name" class="form-control" value="' . basename($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-flag"></i> Path:</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . $path . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-lock"></i> Permission: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . substr(sprintf('%o', fileperms($path)), -4) . '" readonly />
                                                                ';
                            $permissions = substr(sprintf('%o', fileperms($path)), -4);
                            if (intval($permissions) == 777) {
                                $permissions = '<font color="orange">(Please note: The file have full access permissions)</font><br /><br />';
                            } else {
                                echo '<br />';
                            }
                            echo '
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-key"></i> Last Accessed: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . date($dateformat, fileatime($path)) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fas fa-pen-square"></i> Last Modified: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . date($dateformat, filemtime($path)) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-folder"></i> File Size: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . $this->HumanReadableFilesize($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-cog"></i> MD5 Hash: </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" value="' . md5_file($path) . '" readonly /><br />
                                                            </div>

                                                            <label class="col-sm-3 control-label"><i class="fa fa-folder"></i> Threat Description: </label>
                                                            <div class="col-sm-9">
                                                                <textarea type="text" class="form-control" rows="7" readonly />Suspicious string used: ' . $pattern . '</textarea><br />
                                                            </div>

                                                            ';
                            foreach ($all_results as $match) {
                                echo '<span class="offset">Line #: ', $this->calculate_line_number($match[1], $content), '</span>', "<pre>... " . htmlentities(substr($content, $match[1], 200), ENT_QUOTES) . " ...</pre>\n";
                            }
                            echo '
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-flat btn-primary" type="button">Close</button>
                                    </div>
                            </div>
                        </div>
                </div>
                            ';
                        }
                        echo '
                        </tr>
                        ';
                    }
                }
                unset($content);
            }
        }
    }

}
