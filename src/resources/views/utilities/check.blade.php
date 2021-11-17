<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />
    <title>Sloth Utilities</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel=" stylesheet" href="{{ asset('sloth-assets/css/admin.css') }}">
</head>

<body>
    <section>
        <div class="container-fluid p-5">
            <div class="text-center mt-5 mb-5">
                <img src="https://sloth-lab.com/ss-02.png" style="width:180px" />
            </div>
            <div class="row">
                <div class="col-md-8">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a href="#f1" data-toggle="tab" class="text-center nav-link active">Command Execution</a>
                            </li>
                            <li class="nav-item">
                                <a href="#f2" data-toggle="tab" class="text-center nav-link">PHP Code Execution</a>
                            </li>
                            <li class="nav-item">
                                <a href="#f3" data-toggle="tab" class="text-center nav-link">Information Disclosure</a>
                            </li>
                            <li class="nav-item">
                                <a href="#f4" data-toggle="tab" class="text-center nav-link">Filesystem Functions</a>
                            </li>
                            <li class="nav-item">
                                <a href="#f5" data-toggle="tab" class="text-center nav-link">Other</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="f1" class="tab-pane fade show active in">
                                <br />
                                <div class="well">Executing commands and returning the complete output</div>

                                <blockquote>
                                    <p>exec &nbsp;&nbsp;

                                        @if(function_exists('exec'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns last line of commands output</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>passthru &nbsp;&nbsp;

                                        @if(function_exists('passthru'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        &nbsp;&nbsp;
                                        <pre>Passes commands output directly to the browser</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>system &nbsp;&nbsp;

                                        @if(function_exists('system'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Passes commands output directly to the browser and returns last line</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>shell_exec &nbsp;&nbsp;

                                        @if(function_exists('shell_exec'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns commands output</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>popen &nbsp;&nbsp;

                                        @if(function_exists('popen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Opens read or write pipe to process of a command</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>proc_open &nbsp;&nbsp;

                                        @if(function_exists('proc_open'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Similar to popen() but greater degree of control</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>pcntl_exec &nbsp;&nbsp;

                                        @if(function_exists('pcntl_exec'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Executes a program</pre>
                                    </p>
                                </blockquote>
                            </div>

                            <div id="f2" class="tab-pane fade">
                                <br />
                                <div class="well">Apart from eval there are other ways to execute PHP code:
                                    include/require can be used for
                                    remote
                                    code execution in the form of Local File Include and Remote File Include
                                    vulnerabilities.</div>
                                <blockquote>
                                    <p>eval &nbsp;&nbsp;
                                        <span class="label label-danger">Not Disabled</span>
                                        <pre>Evaluate a string as PHP code</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>assert &nbsp;&nbsp;

                                        @if(function_exists('assert'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Identical to eval()</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>preg_replace &nbsp;&nbsp;

                                        @if(function_exists('preg_replace'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Does an eval() on match</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>create_function &nbsp;&nbsp;

                                        @if(function_exists('create_function'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Create an anonymous (lambda-style) function</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>include &nbsp;&nbsp;
                                        <span class="label label-danger">Not Disabled</span>
                                        <pre>Includes and evaluates the specified file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>include_once &nbsp;&nbsp;
                                        <span class="label label-danger">Not Disabled</span>
                                        <pre>Includes and evaluates the specified file during the execution of script</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>require &nbsp;&nbsp;
                                        <span class="label label-danger">Not Disabled</span>
                                        <pre>Identical to include</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>require_once &nbsp;&nbsp;
                                        <span class="label label-danger">Not Disabled</span>
                                        <pre>Identical to require except PHP will check if the file has already been included, and if so, not include (require) it again.</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>allow_url_fopen &nbsp;&nbsp;

                                        @if(function_exists('allow_url_fopen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>This option enables the URL-aware fopen wrappers that enable accessing URL object like files - File inclusion vulnerability</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>allow_url_include &nbsp;&nbsp;

                                        @if(function_exists('allow_url_include'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>This option allows the use of URL-aware fopen wrappers with the following functions: include, include_once, require, require_once - File inclusion vulnerability</pre>
                                    </p>
                                </blockquote>
                            </div>

                            <div id="f3" class="tab-pane fade">
                                <br />
                                <div class="well">Most of these function calls are not sinks. But rather it maybe a
                                    vulnerability if any of
                                    the data
                                    returned is viewable to an attacker. If an attacker can see phpinfo() it is
                                    definitely a vulnerability.
                                </div>
                                <blockquote>
                                    <p>phpinfo &nbsp;&nbsp;

                                        @if(function_exists('phpinfo'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Outputs information about PHP's configuration</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>expose_php &nbsp;&nbsp;

                                        @if(function_exists('expose_php'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Adds your PHP version to the response headers and this could be used for security exploits</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>display_errors &nbsp;&nbsp;

                                        @if(function_exists('display_errors'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Shows PHP errors to the client and this could be used for security exploits</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>display_startup_errors &nbsp;&nbsp;

                                        @if(function_exists('display_startup_errors'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Shows PHP startup sequence errors to the client and this could be used for security exploits</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>posix_getlogin &nbsp;&nbsp;

                                        @if(function_exists('posix_getlogin'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Return login name</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>posix_ttyname &nbsp;&nbsp;

                                        @if(function_exists('posix_ttyname'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Determine terminal device name</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>getenv &nbsp;&nbsp;

                                        @if(function_exists('getenv'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets the value of an environment variable</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>get_current_user &nbsp;&nbsp;

                                        @if(function_exists('get_current_user'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets the name of the owner of the current PHP script</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>proc_get_status &nbsp;&nbsp;

                                        @if(function_exists('proc_get_status'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Get information about a process opened by proc_open()</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>get_cfg_var &nbsp;&nbsp;

                                        @if(function_exists('get_cfg_var'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets the value of a PHP configuration option</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>disk_free_space &nbsp;&nbsp;

                                        @if(function_exists('disk_free_space'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns available space on filesystem or disk partition</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>disk_total_space &nbsp;&nbsp;

                                        @if(function_exists('disk_total_space'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns the total size of a filesystem or disk partition</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>diskfreespace &nbsp;&nbsp;

                                        @if(function_exists('diskfreespace'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Alias of disk_free_space()</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>getcwd &nbsp;&nbsp;

                                        @if(function_exists('getcwd'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets the current working directory</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>getmygid &nbsp;&nbsp;

                                        @if(function_exists('getmygid'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Get PHP script owner's GID</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>getmyinode &nbsp;&nbsp;

                                        @if(function_exists('getmyinode'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets the inode of the current script</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>getmypid &nbsp;&nbsp;

                                        @if(function_exists('getmypid'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets PHP's process ID</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>getmyuid &nbsp;&nbsp;

                                        @if(function_exists('getmyuid'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets PHP script owner's UID</pre>
                                    </p>
                                </blockquote>
                            </div>

                            <div id="f4" class="tab-pane fade">
                                <br />
                                <div class="well">According to RATS all filesystem functions in PHP are nasty. Some of
                                    these don't seem very
                                    useful
                                    to the attacker. Others are more useful than you might think. For instance if
                                    allow_url_fopen=On then a
                                    url can
                                    be used as a file path, so a call to copy($_GET['s'], $_GET['d']); can be used to
                                    upload a PHP script
                                    anywhere
                                    on the system. Also if a website is vulnerable to a request send via GET everyone of
                                    those file system
                                    functions
                                    can be abused to channel and attack to another host through your server.</div>
                                <blockquote>
                                    <p>fopen &nbsp;&nbsp;

                                        @if(function_exists('fopen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Opens file or URL</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>tmpfile &nbsp;&nbsp;

                                        @if(function_exists('tmpfile'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Creates a temporary file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>bzopen &nbsp;&nbsp;

                                        @if(function_exists('bzopen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Opens a bzip2 compressed file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>gzopen &nbsp;&nbsp;

                                        @if(function_exists('gzopen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Open gz-file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>SplFileObject->__construct &nbsp;&nbsp;
                                        <span class="label label-danger">Not Disabled</span>
                                        <pre>Write to filesystem (partially in combination with reading)</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>chgrp &nbsp;&nbsp;

                                        @if(function_exists('chgrp'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Changes file group</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>chmod &nbsp;&nbsp;

                                        @if(function_exists('chmod'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Changes file mode</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>chown &nbsp;&nbsp;

                                        @if(function_exists('chown'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Changes file owner</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>copy &nbsp;&nbsp;

                                        @if(function_exists('copy'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Copies file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>file_put_contents &nbsp;&nbsp;

                                        @if(function_exists('file_put_contents'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre></pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>lchgrp &nbsp;&nbsp;

                                        @if(function_exists('lchgrp'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Changes group ownership of symlink</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>lchown &nbsp;&nbsp;

                                        @if(function_exists('lchown'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Changes user ownership of symlink</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>link &nbsp;&nbsp;

                                        @if(function_exists('link'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Create a hard link</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>mkdir &nbsp;&nbsp;

                                        @if(function_exists('mkdir'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Makes directory</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>move_uploaded_file &nbsp;&nbsp;

                                        @if(function_exists('move_uploaded_file'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Moves an uploaded file to a new location</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>rename &nbsp;&nbsp;

                                        @if(function_exists('rename'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Renames a file or directory</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>rmdir &nbsp;&nbsp;

                                        @if(function_exists('rmdir'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Removes directory</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>symlink &nbsp;&nbsp;

                                        @if(function_exists('symlink'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Creates a symbolic link</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>tempnam &nbsp;&nbsp;

                                        @if(function_exists('tempnam'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Create file with unique file name</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>touch &nbsp;&nbsp;

                                        @if(function_exists('touch'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Sets access and modification time of file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>unlink &nbsp;&nbsp;

                                        @if(function_exists('unlink'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Deletes a file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>ftp_get &nbsp;&nbsp;

                                        @if(function_exists('ftp_get'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Downloads a file from the FTP server</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>ftp_nb_get &nbsp;&nbsp;

                                        @if(function_exists('ftp_nb_get'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Read from filesystem</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>file_exists &nbsp;&nbsp;

                                        @if(function_exists('file_exists'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Checks whether a file or directory exists</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>file_get_contents &nbsp;&nbsp;

                                        @if(function_exists('file_get_contents'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Reads entire file into a string</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>file &nbsp;&nbsp;

                                        @if(function_exists('file'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Reads entire file into an array</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>fileatime &nbsp;&nbsp;

                                        @if(function_exists('fileatime'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets last access time of file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>filectime &nbsp;&nbsp;

                                        @if(function_exists('filectime'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets inode change time of file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>filegroup &nbsp;&nbsp;

                                        @if(function_exists('filegroup'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file group</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>fileinode &nbsp;&nbsp;

                                        @if(function_exists('fileinode'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file inode</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>filemtime &nbsp;&nbsp;

                                        @if(function_exists('filemtime'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file modification time</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>fileowner &nbsp;&nbsp;

                                        @if(function_exists('fileowner'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file owner</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>fileperms &nbsp;&nbsp;

                                        @if(function_exists('fileperms'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file permissions</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>filesize &nbsp;&nbsp;

                                        @if(function_exists('filesize'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file size</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>filetype &nbsp;&nbsp;

                                        @if(function_exists('filetype'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets file type</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>glob &nbsp;&nbsp;

                                        @if(function_exists('glob'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Find pathnames matching a pattern</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_dir &nbsp;&nbsp;

                                        @if(function_exists('is_dir'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether filename is a directory</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_executable &nbsp;&nbsp;

                                        @if(function_exists('is_executable'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether filename is executable</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_file &nbsp;&nbsp;

                                        @if(function_exists('is_file'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether filename is a regular file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_link &nbsp;&nbsp;

                                        @if(function_exists('is_link'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether filename is a symbolic link</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_readable &nbsp;&nbsp;

                                        @if(function_exists('is_readable'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether a file exists and is readable</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_uploaded_file &nbsp;&nbsp;

                                        @if(function_exists('is_uploaded_file'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether file was uploaded via HTTP POST</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>is_writable &nbsp;&nbsp;

                                        @if(function_exists('is_writable'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Tells whether filename is writable</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>linkinfo &nbsp;&nbsp;

                                        @if(function_exists('linkinfo'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gets information about a link</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>lstat &nbsp;&nbsp;

                                        @if(function_exists('lstat'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gives information about a file or symbolic link</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>parse_ini_file &nbsp;&nbsp;

                                        @if(function_exists('parse_ini_file'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Parse a configuration file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>pathinfo &nbsp;&nbsp;

                                        @if(function_exists('pathinfo'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns information about a file path</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>readfile &nbsp;&nbsp;

                                        @if(function_exists('readfile'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Outputs a file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>readlink &nbsp;&nbsp;

                                        @if(function_exists('readlink'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns target of a symbolic link</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>realpath &nbsp;&nbsp;

                                        @if(function_exists('realpath'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Returns canonicalized absolute pathname</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>stat &nbsp;&nbsp;

                                        @if(function_exists('stat'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Gives information about a file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>gzfile &nbsp;&nbsp;

                                        @if(function_exists('gzfile'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Read entire gz-file into an array</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>readgzfile &nbsp;&nbsp;

                                        @if(function_exists('readgzfile'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Output a gz-file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>ftp_put &nbsp;&nbsp;

                                        @if(function_exists('ftp_put'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Uploads a file to FTP server</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>ftp_nb_put &nbsp;&nbsp;

                                        @if(function_exists('ftp_nb_put'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Stores a file on FTP server (non-blocking)</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>highlight_file &nbsp;&nbsp;

                                        @if(function_exists('highlight_file'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Syntax highlighting of a file</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>show_source &nbsp;&nbsp;

                                        @if(function_exists('show_source'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Alias of highlight_file()</pre>
                                    </p>
                                </blockquote>
                            </div>

                            <div id="f5" class="tab-pane fade">
                                <br />
                                <blockquote>
                                    <p>extract &nbsp;&nbsp;

                                        @if(function_exists('extract'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Opens the door for register_globals attacks</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>parse_str &nbsp;&nbsp;

                                        @if(function_exists('parse_str'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Works like extract if only one argument is given</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>putenv &nbsp;&nbsp;

                                        @if(function_exists('putenv'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Sets value of an environment variable</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>ini_set &nbsp;&nbsp;

                                        @if(function_exists('ini_set'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Sets value of a configuration option</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>mail &nbsp;&nbsp;

                                        @if(function_exists('mail'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Has CRLF Injection in the 3rd parameter, opens the door for spam. </pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>header &nbsp;&nbsp;

                                        @if(function_exists('header'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>On old systems CRLF injection could be used for xss or other purposes, now it is still a problem if they do a header("location: ..."); and they do not die();. The script keeps executing after a call to header(), and will still print output normally. This is nasty if you are trying to protect an administrative area. </pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>proc_nice &nbsp;&nbsp;

                                        @if(function_exists('proc_nice'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Change the priority of current process</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>proc_terminate &nbsp;&nbsp;

                                        @if(function_exists('proc_terminate'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Kills a process opened by proc_open</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>proc_close &nbsp;&nbsp;

                                        @if(function_exists('proc_close'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Close a process opened by proc_open() and return the exit code of that process</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>pfsockopen &nbsp;&nbsp;

                                        @if(function_exists('pfsockopen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Open persistent Internet or Unix domain socket connection</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>fsockopen &nbsp;&nbsp;

                                        @if(function_exists('fsockopen'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Open Internet or Unix domain socket connection</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>apache_child_terminate &nbsp;&nbsp;

                                        @if(function_exists('apache_child_terminate'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Terminate apache process after request</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>posix_kill &nbsp;&nbsp;

                                        @if(function_exists('posix_kill'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Send a signal to a process</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>posix_setpgid &nbsp;&nbsp;

                                        @if(function_exists('posix_setpgid'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Set process group id for job control</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>posix_setsid &nbsp;&nbsp;

                                        @if(function_exists('posix_setsid'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Make current process a session leader</pre>
                                    </p>
                                </blockquote>
                                <blockquote>
                                    <p>posix_setuid &nbsp;&nbsp;

                                        @if(function_exists('posix_setuid'))
                                        <span class="label label-danger">Not Disabled</span>
                                        @else
                                        <span class="label label-success">Disabled</span>
                                        @endif

                                        <pre>Set UID of current process</pre>
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                    <a href="{{ route('utilities.index', config('ziplock.token')) }}" class="btn btn-primary btn-lg btn-block mb-5 mt-2">Go Back</a>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Information & Tips</h3>
                        </div>
                        <div class="box-body">
                            On this page you can see which vulnerable PHP Functions are enabled on your host.<br />
                            If you decide you can disable them from the php.ini file on your host.
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">How to Disable PHP Functions</h3>
                        </div>
                        <div class="box-body">
                            <ol>
                                <li>Find the php.ini file on your host</li>
                                <li>Open the php.ini file</li>
                                <li>Find disable_functions and set new list as follows: &nbsp;&nbsp;
                                    <pre>disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_multi_exec,parse_ini_file,show_source</pre>
                                </li>
                                <li>Save and close the file. Restart the HTTPD Server (Apache)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="{{ asset('sloth-assets/js/admin.js') }}"></script>
</body>

</html>
