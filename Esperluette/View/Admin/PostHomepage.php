<?php
namespace Esperluette\View\Admin;

use Esperluette\Model;
use Experluette\View;
use Esperluette\Model\Helper;
use Fwk\FormItem;

class PostHomepage extends \Esperluette\View\Admin
{
    public function render($content = '')
    {   
        
        $output = '<ul class="postlist">'."\n";
        foreach ($this->model as $currentPost) {
            $output .= '<li>';
            $output .= '    <a href="#">';
            $output .= '        <div class="title">' . htmlentities($currentPost->title, ENT_COMPAT, 'UTF-8') . '</div>';
            $output .= '        <time>NICE TIME GOES HERE</time>';
            $output .= '        <div class="status">' . Helper::i18n('post.status.' . $currentPost->getStatus()) . '</div>'."\n";
            $output .= '    </a>';
            $output .= '</li>';
        }

        $output .= '</ul>'."\n";
        return parent::render($output);
    }
}
