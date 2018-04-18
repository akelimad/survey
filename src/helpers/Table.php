<?php
/**
 * Table
 * 
 * @author mchanchaf
 *
 * @package app.table
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Helpers;

class Table extends Pagination {


    /**
     * Query to run
     *
     * @access protected
     * @var    string
     */
    protected $_query;


    /**
     * Table primary key
     *
     * @access protected
     * @var    string
     */
    protected $primary_key;


    /**
     * Array of options for the pagination
     *
     * @access protected
     * @var    array
     */
    protected $_options = array(
        'bulk_actions' => false,
        'actions' => true,
        'show_thead' => true,
        'show_footer' => false,
        'show_increment' => false,
        'show_before_table_form' => true,
        'head_actions_width' => null
    );


    /**
     * Order by
     *
     * @access protected
     * @var    int
     */
    protected $orderby;


    /**
     * Order
     *
     * @access protected
     * @var    int
     */
    protected $order = 'ASC';


    /**
     * current_page
     *
     * @access protected
     * @var    int
     */
    protected static $currentPage;


    /**
     * perpage
     *
     * @access protected
     * @var    int
     */
    protected $perpage = 10;


    /**
     * Perpages
     *
     * @access protected
     * @var    bool
     */
    protected $perpages = array(5, 10, 15, 20, 50, 100);


    /**
     * The total results of the query
     *
     * @access public
     * @var    int
     */
    public $total_results = 0;


    /**
     * The total pages returned
     *
     * @access public
     * @var    int
     */
    public $total_pages = 0;


    /**
     * The pagination links (as an array)
     *
     * @access public
     * @var    array
     */
    public $links_array;


    /**
     * The pagination links (Presented as an UL)
     *
     * @access public
     * @var    string
     */
    public $links_html;


    /**
     * The pagination links (as an array)
     *
     * @access public
     * @var    array
     */
    public $rows;


    /**
     * Table headers
     *
     * @access protected
     * @var    array
     */
    protected $headers;


    /**
     * Table headers sortables
     *
     * @access protected
     * @var    array
     */
    protected $sortables;


    /**
     * Table body templates
     *
     * @access protected
     * @var    array
     */
    protected $templates;

    /**
     * $columnOptions
     *
     * @access protected
     * @var    array
     */
    protected $columnOptions;


    /**
     * Table classes
     *
     * @access protected
     * @var    array
     */
    protected $table_classes;


    /**
     * Table id
     *
     * @access protected
     * @var    string
     */
    protected $table_id = 'etaTable';


    /**
     * Tell if all done
     *
     * @access protected
     * @var    bool
     */
    protected $_success = false;


    /**
     * Increment
     *
     * @access protected
     * @var    bool
     */
    protected $increment = null;


    /**
     * Table actions
     *
     * @access protected
     * @var    array
     */
    protected $_actions = array(
        'edit' => array(
            'name' => 'edit',
            'label' => 'Modifier',
            'patern' => 'action=edit&id={primary_key}',
            'icon' => 'fa fa-pencil',
            'permission' => true,
            'bulk_action' => false,
            'sort_order' => 10,
            'attributes' => array(
                'class' => 'btn btn-primary btn-xs'
            ),
            'callback' => null
        ),
        'delete' => array(
            'name' => 'delete',
            'label' => 'Supprimer',
            'patern' => 'action=delete&id={primary_key}',
            'icon' => 'fa fa-trash',
            'permission' => true,
            'bulk_action' => true,
            'sort_order' => 20,
            'attributes' => array(
                'class' => 'btn btn-danger btn-xs'
            ),
            'callback' => null
        ),
    );


    /**
     * Table triggers
     *
     * @access protected
     * @var    array
     */
    protected $triggers = array(
        'before_sort',
        'table_notes'
    );

    /**
     * Class constructor
     *
     * @access  public
     * @param   string $query The query to run on the database
    * @param   array $options An array of options
     * 
     * @return  void
     */
    public function __construct($query, $primary_key, $options=[])
    {
        $this->_query = $query;
        $this->primary_key = $primary_key;
        $this->_options = array_merge($this->_options, $options);
        $this->_options['text_prev'] = '<i class="fa fa-angle-double-left"></i>&nbsp;'. trans("Précédent");
        $this->_options['text_next'] = trans("Suivant"). '&nbsp;<i class="fa fa-angle-double-right"></i>';

        // Set url
        if( !isset($options['url']) ) {
            $this->_options['url'] = self::getPaginationUrl();
        }

        if( !isset($options['db_handle']) ) {
            $this->_options['db_handle'] = getDB()->pdo;
        }

        if( isset($options['text_prev']) ) {
            $this->_options['text_prev'] = $options['text_prev'];
        }

        if( isset($options['text_next']) ) {
            $this->_options['text_next'] = $options['text_next'];
        }

        if( isset($options['currentPage']) ) {
            self::$currentPage = $options['currentPage'];
        }
        
        if( isset($_GET['module']) ) {
            $path = (isBackend()) ? 'backend/module/' : '';
            $this->setAction('edit', ['patern' => site_url($path . $_GET['module'] .'/'. $_GET['controller'] .'/edit/{primary_key}')]);
            $this->setAction('delete', ['patern' => site_url($path . $_GET['module'] .'/'. $_GET['controller'] .'/delete/{primary_key}')]);
        }

    }


    /**
     * Run query and get results
     *
     * @return object this
     */
    public function _run()
    {
        // Set order by
        if(isset($_GET['orderby'])) $this->setOrderby($_GET['orderby']);

        // Set order
        if(isset($_GET['order'])) $this->setOrder($_GET['order']);

        // Set results per page
        if(isset($_GET['perpage'])) $this->setPerpage($_GET['perpage']);


        // Set perpage
        $this->_options['results_per_page'] = $this->perpage;

        // Update query
        // && !empty($this->headers) && array_key_exists($this->orderby, $this->headers)
        if( !is_null($this->orderby) ) {
            $this->_query .= " ORDER BY {$this->orderby} {$this->order}";
        }

        // return $this;
        try {

            $options = array();
            foreach ($this->_options as $key => $value) {
                if( isset($this->options[$key]) ) {
                    $options[$key] = $value;
                }
            }

            $pagi = new Pagination(self::getPage(), $this->_query, $options);

            if( true === $pagi->success ){
                $this->_success = true;
                $this->total_pages = $pagi->total_pages;
                $this->total_results = $pagi->total_results;
                $this->links_html = $pagi->links_html;
                $this->links_array = $pagi->links_array;
                $this->rows = $pagi->resultset->fetchAll(\PDO::FETCH_OBJ);
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }

        return $this;
    }


    /**
     * Render table
     *
     * @return string html
     */
    public function render($echo=true)
    {
        if( !$this->_success ) {
            $this->_run();
        }

        $html = '';
        if( empty($this->headers) ) {
            if( !isset($this->rows[0]) ) return $html;
            foreach ($this->rows[0] as $key => $value) {
                $this->headers[$key] = $key;
            }
        }

        // Table ID
        $table_id = (!is_null($this->table_id)) ? 'id="'. $this->table_id .'"' : '';

        // Table Classess
        $table_classes = (!empty($this->table_classes)) ? 'class="'. implode(' ', $this->table_classes) .' etaTable"' : 'etaTable';

        if( $this->_options['show_before_table_form'] ) {
            $html .= '<form method="get" action="" class="form-inline" id="etalent-table-filter">';
            $html .= '<div class="row" style="margin-bottom: 10px;">';
            $html .= '<div class="col-md-12">';

                /*if( $this->total_results > 0 ) {
                    $show_start = (($this->perpage * self::getPage()) - $this->perpage)+1;
                    $show_end = ($show_start + $this->perpage)-1;
                    if( $show_end > $this->total_results ) $show_end = $this->total_results;
                    $html .= '<strong>Affichage de '.$show_start.' à '.$show_end.' des '.$this->total_results.' entrées</strong>'; //  style="margin-left: 10px;"
                }*/

                if( 
                    isset($this->triggers['table_notes']) &&
                    $this->triggers['table_notes'] != '' && 
                    is_callable($this->triggers['table_notes']) 
                ) {
                    $html .= call_user_func($this->triggers['table_notes']);
                }
                
                $html .= '</div>';
                /*$html .= '<div class="col-md-9">';
                // if( !in_array($this->perpage, $perpages) ) $perpages[] = $this->perpage;
                // sort($perpages);
                $html .= '<div class="pull-right">';
                if( 
                    isset($this->triggers['before_sort']) &&
                    $this->triggers['before_sort'] != '' && 
                    is_callable($this->triggers['before_sort']) 
                ) {
                    $html .= call_user_func($this->triggers['before_sort']);
                }
                $html .= '<div class="form-group">';
                    // $html .= '<label for="status">Afficher par</label>';
                    $html .= '<select id="'.$this->table_id.'_perpage" class="etaTable_perpage">';
                    foreach ($this->perpages as $key => $value) {
                        $selected = ($this->perpage==$value) ? 'selected' : '';
                        $html .= '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                    }
                    $html .= '</select>';
                $html .= '</div>';

                $html .= '</div>';
                $html .= '</div>';*/
                $html .= '</div>';
                $html .= '</form>';
            }

            $html .= '<form method="post" action="" class="form-inline '.$this->table_id.'Form" id="etalent-table-wraper">';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-12 table-responsive">';
            $html .= '<table '.$table_classes.' '.$table_id.'>';
            $rowspan = count($this->headers);

            $thead = '';
            if( $this->_options['show_thead'] && $this->total_results > 0 ) {
                $html .= '<thead><tr>';

                if( $this->_options['bulk_actions'] && $this->hasBulkActions() ) :
                    $thead .= '<th><input type="checkbox" value="" class="'.$this->table_id.'_checkAll etaTable_checkAll"></th>';
                    $rowspan += 1;
                elseif( $this->_options['show_increment'] ) :
                    $thead .= '<th>#</th>';
                    $rowspan += 1;
                endif;

                foreach ($this->headers as $key => $header) {

                    $colAttrs = '';
                    if (!isset($this->columnOptions[$key]['attributes']['class']))
                        $this->columnOptions[$key]['attributes']['class'] = '';

                    $this->columnOptions[$key]['attributes']['class'] .= ' '.$key;

                    if( !empty($this->sortables) && in_array($key, $this->sortables) ) {
                        if (isset($this->columnOptions[$key]['attributes']['title'])) {
                            $title = $this->columnOptions[$key]['attributes']['title'];
                            $this->columnOptions[$key]['attributes']['title'] = trans("Trier par:") .'&nbsp;'.$title;
                        } else {
                            $this->columnOptions[$key]['attributes']['title'] = trans("Trier par:") .'&nbsp;'.$header;
                        }
                    }

                    if( !empty($this->columnOptions[$key]['attributes']) ) : 
                        foreach ($this->columnOptions[$key]['attributes'] as $k => $v) :
                            $colAttrs .= $k.'="'.$v.'"';
                        endforeach; 
                    endif;

                    if( !empty($this->sortables) && in_array($key, $this->sortables) ) {
                        if( $this->orderby == $key ) {
                            $sort = (strtolower($this->order)=='asc') ? 'desc' : 'asc';
                        } else {
                            $sort = 'asc';
                        }

                        $sort_link = $this->getSortLink($key);
                        $thead .= '<th '.$colAttrs.'>';
                        $thead .= '<a href="'. $sort_link .'" class="sort"><i class="fa fa-sort-amount-'. $sort .'"></i>&nbsp;'. $header .'</a></th>';
                    } else {
                        $thead .= '<th '.$colAttrs.'>'. $header .'</th>';
                    }
                }
                if( $this->_options['actions'] ) :
                    $width = (!is_null($this->_options['head_actions_width'])) ? $this->_options['head_actions_width'] : count($this->_actions) * 35;
                    $thead .= '<th width="'. $width .'px" class="actions">'. trans("Actions") .'</th>';
                    $rowspan += 1;
                endif;
                $html .= $thead . '</tr></thead>';
            }

            $html .= '<tbody>';
            $headers = array_keys($this->headers);
            if( !empty($this->rows) ) : foreach ($this->rows as $key => $row) :
                $html .= '<tr>';
                $columns = array_merge(array_flip($headers), (array) $row);

                if( $this->_options['bulk_actions'] && $this->hasBulkActions() ) :
                    $html .= '<td class="bulk-cb"><input type="checkbox" name="'. $this->table_id .'_items[]" value="'. $columns[$this->primary_key] .'" class="'. $this->table_id .'_cb etaTable_cb"></td>';
                elseif( $this->_options['show_increment'] ) :
                    $html .= '<td>'. $this->getIncrement() .'</td>';
                    $rowspan += 1;
                endif;

                foreach ($columns as $key => $column) {
                    if( !isset($this->headers[$key]) ) continue;
                    if( isset($this->templates[$key]) ) {
                        if(is_callable($this->templates[$key])) {
                            $row->object = $this;
                            $column = call_user_func($this->templates[$key], $row);
                        } else {
                            $column = $this->parseTemplate($this->templates[$key], $columns);
                        }
                    }
                    $html .= '<td class="'.$key.'">'. $column .'</td>';
                }

                    // Get actions links
                if( $this->_options['actions'] ) :
                    $html .= '<td width="105" class="actions">'. $this->getActionsLinks($columns, $row) .'</td>';
                endif;

                $html .= '</tr>';
            endforeach; else :

            $html .= '<tr><td class="empty" colspan="'. $rowspan .'" style="text-align: center; border-top: 3px solid #e32b2b !important; border-bottom: 3px solid #e32b2b !important;">'. trans("Aucune donnée à afficher.") .'</td></tr>';

                endif; // END Table
                $html .= '</tbody>';

                if( $this->_options['show_footer'] && $this->total_results > 0 ) {
                    $html .= '<tfoot><tr>'. $thead .'<tr></tfoot>';
                }           

                $html .= '</table>';
            $html .= '</div></div>';// End table row

            if( $this->total_results > 0 ) {
                $html .= '<div class="row">';


                if( $this->_options['bulk_actions'] && $this->hasBulkActions() ) :
                    $html .= '<div class="col-md-5" id="bulk-wrap">';
                    $html .= '<select name="'. $this->table_id .'_action" required>';
                    $html .= '<option value="">'. trans("Actions groupées") .'</option>';
                    foreach ($this->_actions as $key => $action)
                    {
                        if( $key == 'edit' || !$action['bulk_action'] ) continue;
                        $callable = (!is_null($action['callback']) && $action['callback']!='') ? 'data-callback="'.$action['callback'].'"' : '';
                        $bulk_label = (isset($action['bulk_label'])) ? $action['bulk_label'] : $action['label'];
                        $html .= '<option value="'. $key .'" '.$callable.'>'. $bulk_label .'</option>';
                    }
                    $html .= '</select>&nbsp;';
                    $html .= '<input type="submit" class="espace_candidat" value="'. trans("Appliquer") .'" style="padding: 0px 8px;border: 0px;margin-right: 5px;">';
                    $html .= '<div class="form-group">';
                    $html .= '<select id="'.$this->table_id.'_perpage" class="etaTable_perpage">';
                    foreach ($this->perpages as $key => $value) {
                        $selected = ($this->perpage==$value) ? 'selected' : '';
                        $html .= '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                    }
                    $html .= '</select>';
                    $html .= '</div>';
                    $html .= '</div>';
                endif;

                    // add pagination
                if( !empty($this->links_html) ) {
                    $links_pull = ( $this->_options['bulk_actions'] && $this->hasBulkActions() ) ? 'pull-right' : 'pull-left';
                    $col_width = ($this->_options['bulk_actions']) ? 'col-md-7' : 'col-md-12';
                    $html .= '<div class="'. $col_width .' pagination-wrap"><div class="'. $this->table_id .'_pagination '.$links_pull.'">';
                    $html .= $this->links_html;
                    $html .= '</div></div>';
                }
                $html .= '</div>';
            }
            $html .= '</form>';

            if( $echo ) {
                echo $html;
            } else {
                return $html;
            }
        }

        public function getActions()
        {
            return $this->_actions;
        }


    /**
     * Get actions links
     *
     * @param array $columns
     *
     * @return html $links
     */
    public function getActionsLinks($columns, $row)
    {
        $html = '';
        $i = 0;

        // $this->sortActions();
        
        foreach ($this->_actions as $actionName => $action)
        {
            $permission = $action['permission'];
            if( is_callable($permission) ) {
                $row->table_action = $action;
                $permission = call_user_func($permission, $row);
            }

            $i++;

            if( $permission !== true ) continue;

            // permission
            $label = ($action['icon']!='') ? '<i class="'.$action['icon'].'"></i>' : trans($action['label']);

            $columns['primary_key'] = $columns[$this->primary_key];
            // $patern = str_replace('primary_key', $this->primary_key, $action['patern']);

            $actionLink = $this->parseTemplate($action['patern'], $columns);
            
            if ( substr($actionLink, 0, 1) === "/" ) {
                $actionLink = site_url(ltrim($actionLink, '/'));
            }

            $sep = ( strpos($actionLink, '?') === false ) ? '?' : '&'; 

            if (strpos($actionLink, 'http') === false && $action['patern'] != '#') {
                $actionLink = $sep . $actionLink;
            }
            
            if( $action['patern'] == '#' ) $actionLink = 'javascript:void(0)';

            $attrs = '';
            if( !empty($action['attributes']) ) : foreach ($action['attributes'] as $key => $attr) :

                $attrs .= $key. '="'. $this->parseTemplate($attr, $columns);
                if( $key == 'class' ) $attrs .= ' '. $actionName;
                $attrs .= '" ';

            endforeach; endif;

            if( $actionName == 'delete'  ) {
                if( !is_null($action['callback']) ) {
                    $confirm = 'onclick="return confirmMessage(event, \''.$action['callback'].'\', ['. $columns[$this->primary_key] .']);"';
                } else {
                    $confirm = 'onclick="return confirmMessage(event);"';
                }
            } else {
                $confirm = (!is_null($action['callback']) && $action['callback']!='') ? 'onclick="return '. $action['callback'] .'(event, ['. $columns[$this->primary_key] .']);"' : '';
            }

            $html .= '<a style="width:24px;" title="'. trans($action['label']) .'" href="'. $actionLink .'" '. $attrs .' '. $confirm .'>'. $label .'&nbsp;</a>';

            // if($i < count($this->_actions)) $html .= '&nbsp;';
            if($i%3 != 0) $html .= '&nbsp;';
        }
        return $html;
    }


    public function sortActions()
    {
        $sort_ascending = true;
        $subkey = 'sort_order';

        $temp_array[key($this->_actions)] = $this->_actions;

        foreach($this->_actions as $key => $val){
            $offset = 0;
            $found = false;
            foreach($temp_array as $tmp_key => $tmp_val)
            {
                if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey])) {
                    $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                        array($key => $val),
                        array_slice($temp_array,$offset)
                    );
                    $found = true;
                }
                $offset++;
            }
            if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
        }

        if ($sort_ascending) {
            $this->_actions = array_reverse($temp_array);
        } else {
            $this->_actions = $temp_array;
        } 
    }


    /**
     * Tell if has Bulk Actions
     *
     * @return int $page
     */
    public function hasBulkActions()
    {
        foreach ($this->_actions as $actionName => $action) {
            if( $action['bulk_action'] ) return true;
        }
        return false;
    }

    /**
     * Get current page number
     *
     * @return int $page
     */
    public static function getPage($param = 'page')
    {
        if( is_null(self::$currentPage) ) {
            return (isset($_GET[$param]) && is_numeric($_GET[$param]) && $_GET[$param] > 0) ? intval($_GET[$param]) : 1;
        }
        return self::$currentPage;
    }

    /**
     * Set page number
     *
     * @return int $number
     */
    public static function setPage($number)
    {
        self::$currentPage = $number;
    }


    /**
     * Get sort link
     *
     * @return string $url
     */
    public function getSortLink($field)
    {
        $url = self::getCurrentUrl();

        $sep = self::getSeparator();

        if( isset($_GET['orderby']) ) {
            $arr = explode("orderby=", $url, 2);
            $sep = substr($arr[0], -1);
            $orderby = strtolower($this->orderby);
            $url = str_replace($sep.'orderby='. $orderby, $sep .'orderby='.$field, $url);
        } else {
            $url .= $sep .'orderby='. $field;
        }


        $sort = (strtolower($this->order)=='asc') ? 'desc' : 'asc';
        if( isset($_GET['order']) ) {
            $arr = explode("order=", $url, 2);
            $sep = substr($arr[0], -1);
            $oldsort = strtolower($this->order);
            $url = str_replace($sep.'order='. $oldsort, $sep .'order='.$sort, $url);
        } else {
            $url .= '&order='. $sort;
        }

        return $url;
    }    


    /**
     * Get current Url
     *
     * @return string $url
     */
    public static function getCurrentUrl()
    {
        if (is_ajax()) {
            return $_SERVER['HTTP_REFERER'];
        } else {
            $scheme = (isset($_SERVER['REQUEST_SCHEME'])) ? $_SERVER['REQUEST_SCHEME'] : 'http';
            $url = $scheme . '://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            return $url;
        }
    }


    /**
     * Set current url
     *
     * @return string url
     */
    public static function getPaginationUrl($param = 'page')
    {
        $url = self::getCurrentUrl();
        $sep = self::getSeparator();

        if( isset($_GET[$param]) && !is_ajax() ) {
            $arr = explode($param ."=", $url, 2);
            $sep = substr($arr[0], -1);
            $currentPage = self::getPage($param);
            $url = str_replace($sep. $param .'='. $currentPage, $sep . $param . '=*VAR*', $url);
        } else {
            if (strpos($url, $param . '=') !== false) {
                $url = preg_replace("/$param=[0-9]+/", $param ."=*VAR*", $url);
            } elseif (strpos($url, '?') !== false) {
                $url = str_replace('?', '?'. $param .'=*VAR*&', $url);
            } else {
                $url .= '?'. $param .'=*VAR*';
            }
        }
        return $url;
    }


    /**
     * Set perpage
     *
     * @return void
     */
    public function setPerpage($perpage)
    {
        $this->perpage = (intval($perpage) < 500) ? intval($perpage) : 10;
    }


    /**
     * Get perpage
     *
     * @return void
     */
    public function getPerpage()
    {
        return $this->perpage;
    }


    /**
     * Get Increment
     *
     * @return void
     */
    public function getIncrement()
    {
        $page = self::getPage();
        $perpage = $this->getPerpage();
        if( is_null($this->increment) ) {
            $this->increment = (($perpage * $page) - $perpage)+1;
        } else {
            $this->increment +=1;
        }
        return $this->increment;
    }


    /**
     * Set orderby
     *
     * @return void
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
    }


    /**
     * Set order
     *
     * @return void
     */
    public function setOrder($order)
    {
        if( !in_array(strtolower($order), ['asc', 'desc']) ) return;

        $this->order = strtoupper($order);
    }


    /**
     * Set Table Headers
     *
     * @param array $headers
     *
     * @return void
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }


    /**
     * Set table header sortables
     *
     * @param array $sortables
     *
     * @return void
     */
    public function setSortables($sortables)
    {
        $this->sortables = $sortables;
    }


    /**
     * Set table classess
     *
     * @param array classes
     *
     * @return void
     */
    public function setTableClass($classes=[])
    {
        $this->table_classes = $classes;
    }


    /**
     * Set table action
     *
     * @param string name
     * @param array args
     *
     * @return void
     */
    public function setAction($name, $args=[])
    {
        if( in_array($name, ['edit', 'delete']) ) {
            $default = $this->_actions[$name];
        } else {
            $default = array(
                'name' => $name,
                'label' => trans("Sans titre"),
                'patern' => '#',
                'icon' => '',
                'permission' => true,
                'bulk_action' => true,
                'sort_order' => (count($this->_actions) + 1),
                'attributes' => array(
                    'class' => 'btn btn-default btn-xs'
                ),
                'callback' => null
            );
        }
        $args = array_replace_recursive($default, $args);
        $this->_actions[$name] = $args;
    }

    /**
     * Set trigger
     *
     * @param string name
     * @param callable callable
     *
     * @return void
     */
    public function setTrigger($name, $callable)
    {
        return $this->triggers[$name] = $callable;
    }


    /**
     * Remove action
     *
     * @param array names
     *
     * @return void
     */
    public function removeActions($names=[])
    {
        if( empty($names) ) return;

        foreach ($names as $key => $name) {
            unset($this->_actions[$name]);
        }
    }


    /**
     * Set table id
     *
     * @param array id
     *
     * @return void
     */
    public function setTableId($id)
    {
        $this->table_id = $id;
    }


    /**
     * Set Templates
     *
     * @param array templates
     *
     * @return void
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;
    }


    /**
     * Parse Template.
     *
     * @param string template
     * @param array values
     *
     * @return string html
     */
    public function parseTemplate($template, $values)
    {
        $html = preg_replace_callback('#{([^}]+)}#', function($m) use ($template, $values){

            if (strpos($template, '|') !== false) {
                $tpl = explode('|', $m[1]);
                if(isset($tpl[1]) && isset($values[$tpl[0]])) {
                    switch ($tpl[1]) {
                        case 'date':
                        $format = (isset($tpl[2])) ? $tpl[2] : 'd/m/Y';
                        return date($format, strtotime($values[$tpl[0]]));
                        break;
                        case stristr($tpl[1], 'letters_limit') : 
                        $parts = explode(',', $tpl[1]);
                        if( isset($parts[1]) ) {
                            return letters_limit($values[$tpl[0]], $parts[1]);
                        }
                        break;
                    }
                }
            } if(isset($values[$m[1]])){
                return $values[$m[1]];
            }else{
                return $m[0];
            }
        }, $template);

        return $html;
    }


    /**
     * Add table column
     *
     * @param string $id
     * @param string $name
     * @param callable $callback
     * @param array $options
     *
     * @return void
     * @since 2017-10-30
     */
    public function addColumn($id, $name, $callback, $options=[])
    {
        if( !isset($this->headers[$id]) ) $this->headers[$id] = $name;
        $this->templates[$id] = $callback;
        $this->columnOptions[$id] = $options;
    }
    

    /**
     * Get url separator ?/&
     *
     * @return string $separator
     */
    public static function getSeparator()
    {
        $separator = '?';
        if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
            $separator = '&';
        }
        return $separator;
    }


} /* End Class */