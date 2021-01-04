<?php


namespace Modules\Backend\Http\Services;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

class GlobalServices
{
    public function getAllPermissions(): array
    {

        $array = [];
        $permission = ['view', 'edit', 'create', 'delete'];
        $classes = $this->getAllModal();
        foreach ($permission as $item) {
            foreach ($classes as $class) {
                $array[]['name'] = $class . '-' . $item;

            }
        }
        return $array;
    }

    public function getAllModal(): array
    {
        $path = module_path('Backend') . DIRECTORY_SEPARATOR . 'Entities';
        $array = [];
        $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $phpFiles = new RegexIterator($allFiles, '/\.php$/');
        foreach ($phpFiles as $phpFile) {
            $content = file_get_contents($phpFile->getRealPath());
            $tokens = token_get_all($content);
            $namespace = '';
            for ($index = 0; isset($tokens[$index]); $index++) {
                if (!isset($tokens[$index][0])) {
                    continue;
                }
                if (T_NAMESPACE === $tokens[$index][0]) {
                    $index += 2; // Skip namespace keyword and whitespace
                    while (isset($tokens[$index]) && is_array($tokens[$index])) {
                        $namespace .= $tokens[$index++][1];
                    }
                }
                if (T_CLASS === $tokens[$index][0] && T_WHITESPACE === $tokens[$index + 1][0] && T_STRING === $tokens[$index + 2][0]) {
                    $index += 2; // Skip class keyword and whitespace
                    $array[] = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $tokens[$index][1]));

                    # break if you have one class per file (psr-4 compliant)
                    # otherwise you'll need to handle class constants (Foo::class)
                    break;
                }
            }

        }

        return $array;
    }
}
