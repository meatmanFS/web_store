<?php

class webStore
{
    public function __construct() 
    {
        add_action('init', 'post_type');
        function post_type()
        {
            //Заказы
            $labels = array(
                  'name' => 'Заказы', 
                  'singular_name' => 'Заказ', 
                  'add_new' => 'Добавить новый',
                  'add_new_item' => 'Добавить новый заказ',
                  'edit_item' => 'Редактировать заказ',
                  'new_item' => 'Новый заказ',
                  'view_item' => 'Посмотреть заказ',
                  'search_items' => 'Найти заказ',
                  'not_found' =>  'Заказов не найдено',
                  'not_found_in_trash' => 'В корзине заказов не найдено',
                  'parent_item_colon' => '',
                  'menu_name' => 'Заказы'

            );
            $args = array(
                  'labels' => $labels,
                  'public' => true,
                  'publicly_queryable' => true,
                  'taxonomies' => array( 'Способ доставки', 'Статус' ),
                  'show_ui' => true,
                  'show_in_menu' => true,
                  'query_var' => true,
                  'rewrite' => true,
                  'capability_type' => 'post',
                  'has_archive' => true,
                  'hierarchical' => false,
                  'menu_position' => 5,
                  'supports' => array('title','editor','author','thumbnail')
            );
            register_post_type('orders',$args);

            //Товары

            $labels = array(
                  'name' => 'Товары', 
                  'singular_name' => 'Товар', 
                  'add_new' => 'Добавить новый',
                  'add_new_item' => 'Добавить новый товары',
                  'edit_item' => 'Редактировать товар',
                  'new_item' => 'Новый товар',
                  'view_item' => 'Посмотреть товар',
                  'search_items' => 'Найти товар',
                  'not_found' =>  'Товаров не найдено',
                  'not_found_in_trash' => 'В корзине товаров не найдено',
                  'parent_item_colon' => '',
                  'menu_name' => 'Товары'

            );
            $args = array(
                  'labels' => $labels,
                  'public' => true,
                  'publicly_queryable' => true,
                  'taxonomies' => array( 'Способ доставки', 'Статус' ),
                  'show_ui' => true,
                  'show_in_menu' => true,
                  'query_var' => true,
                  'rewrite' => true,
                  'taxonomies' => array( 'category', 'post_tag' ),
                  'capability_type' => 'post',
                  'has_archive' => true,
                  'hierarchical' => false,
                  'menu_position' => 6,
                  'supports' => array('title','editor','author','thumbnail')
            );
            register_post_type('products',$args);
        }

        add_action('init', 'add_taxonomies',0);
        function add_taxonomies()
        {
            // Способ
            $labels = array(
                'name' => __( 'Способ доставки', 'taxonomy general name' ),
                'singular_name' => __( 'Способ доставки', 'taxonomy singular name' ),
                'all_items' => __( 'Все способы доставки' ),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __( 'Редактировать способы доставки' ),
                'update_item' => __( 'Обновить способ доставки' ),
                'add_new_item' => __( 'Добавить способ доставки' ),
                'new_item_name' => __( 'Новый способ доставки' ),
                'separate_items_with_commas' => __( 'Способы доставки, разделенные запятой' ),
                'add_or_remove_items' => __( 'Добавить или удалить способы доставки' ),
                'menu_name' => __( 'Способ доставки' ),
            ); 

            register_taxonomy('shipping', 'orders',array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'Способ доставки' ),
            ));
            //Статус
            $labels = array(
                'name' => __( 'Статус доставки', 'taxonomy general name' ),
                'singular_name' => __( 'Статус доставки', 'taxonomy singular name' ),
                'all_items' => __( 'Все Статусы доставки' ),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __( 'Редактировать статус доставки' ),
                'update_item' => __( 'Обновить статус доставки' ),
                'add_new_item' => __( 'Добавить статус доставки' ),
                'new_item_name' => __( 'Новый статус доставки' ),
                'separate_items_with_commas' => __( 'Статус доставки, разделенные запятой' ),
                'add_or_remove_items' => __( 'Добавить или удалить статусы доставки' ),
                'menu_name' => __( 'Статус доставки' ),
            ); 

            register_taxonomy('status', 'orders',array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'Статус доставки' ),
            ));

            //----термины таксономий----//
            //отправка 
            $parent_term = term_exists( 'shipping', 'orders' ); 
            $parent_term_id = $parent_term['term_id']; 
            wp_insert_term(
              'Самовывоз', 
              'shipping', 
              array(
                    'description'=> 'Вывоз самому.',
                    'slug' => 'self_shipping',
                    'parent'=> $parent_term_id
              )
            );

            $parent_term = term_exists( 'shipping', 'orders' ); 
            $parent_term_id = $parent_term['term_id']; 
            wp_insert_term(
              'Доставка почтой', 
              'shipping', 
              array(
                    'description'=> 'Доставка почтой.',
                    'slug' => 'post_shipping',
                    'parent'=> $parent_term_id
              )
            );

            $parent_term = term_exists( 'shipping', 'orders' ); 
            $parent_term_id = $parent_term['term_id']; 
            wp_insert_term(
              'Курьерская доставка', 
              'shipping', 
              array(
                    'description'=> 'Курьерская доставка.',
                    'slug' => 'cureer_shipping',
                    'parent'=> $parent_term_id
              )
            );
            //статус 
            $parent_term = term_exists( 'status', 'orders' ); 
            $parent_term_id = $parent_term['term_id']; 
            wp_insert_term(
              'Обрабатывается', 
              'status', 
              array(
                    'description'=> 'Обрабатывается.',
                    'slug' => 'processed',
                    'parent'=> $parent_term_id
              )
            );

            $parent_term = term_exists( 'status', 'orders' ); 
            $parent_term_id = $parent_term['term_id']; 
            wp_insert_term(
              'Отправлен', 
              'status', 
              array(
                    'description'=> 'Отправлен.',
                    'slug' => 'send',
                    'parent'=> $parent_term_id
              )
            );


            $parent_term = term_exists( 'status', 'orders' ); 
            $parent_term_id = $parent_term['term_id']; 
            wp_insert_term(
              'Отклонен', 
              'status', 
              array(
                    'description'=> 'Отклонен.',
                    'slug' => 'decline',
                    'parent'=> $parent_term_id
              )
            );
        }
        add_shortcode('product_order', array($this, 'shortcode'));
    }
    public function validate($arr)
    {
        foreach ($arr as $item=>$val)
        {
            $arr[$item]= trim(htmlspecialchars(stripslashes($val)));
        }
        foreach ($arr as $item=>$val)
        {
            switch ($item)
            {
                case "email":$arr["valid"][]=array("$item"=>(preg_match("/^.+@.+[.].{2,}$/i", $val))?"valid":"not_valid");break;
                case "login":$arr["valid"][]=array("$item"=>(preg_match("/^[A-z0-9]{3,}$/", $val))?"valid":"not_valid");break;
                case "password":$arr["valid"][]=array("$item"=>(preg_match("/^[A-z0-9]{6,16}$/i", $val))?"valid":"not_valid");break;
                case "phone":$arr["valid"][]=array("$item"=>(preg_match("/^[0-9]{10}$/i", $val))?"valid":"not_valid");break;
                case "name":$arr["valid"][]=array("$item"=>(preg_match_all("/^[A-zА-я .]{3,}$/u", $val))?"valid":"not_valid");break;
                case "text":$arr["valid"][]=array("$item"=>(preg_match("/[\w]{3,}/i", $val))?"valid":"not_valid");break;
                case "birth_day":$arr["valid"][]=array("$item"=>(preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/i", $val))?"valid":"not_valid");break;
            }
        }
        return $arr;
    }
    public function shortcode()
    {
        $all_posts = get_posts(array(
                'numberposts'     => -1,
                'orderby'         => 'post_date',
                'order'           => 'DESC',
                'post_type'       => 'products',
                'post_status'     => 'publish'
        )); 
        
        if ($_POST)
        {
            $return = "";
            $validate = $this->validate(array("email"=>$_POST["inputEmail"],"name"=>$_POST["inputName"]));
            $valid = true;
            foreach ($validate['valid'] as $valid_in)
            {
                foreach ($valid_in as $item=>$val )
                {
                    if ($val!="valid")
                    {
                        $return .= "<h2 class='err'>Введите валидный $item!</h2><br>";
                        $valid = false;
                    }

                }
            }
            $user_data = get_userdata(get_current_user_id());
            $user_email = $user_data->data->user_email;
            $user_name =$user_data->display_name;
            if ($valid)
            {
                $user_name = ($user_name)?$user_name:$validate["name"];
                $user_email = ($user_email)?$user_email:$validate["email"];
                $source = array(
                'post_title' => 'Заказ '.date("d-m-Y"),              
                'post_name' => 'zakaz '.date("d-m-Y"),                
                'post_content' => '<p>Заказчик по имени '.$user_name.' заказал '.$_POST["inputProduct"].'.</p><br>'
                    . '<p>Также он указал имейл '.$user_email.'</p>',   
                'post_status' => 'publish',                      
                'post_author' => 1,                              
                'post_type' => 'orders',   
                'tax_input'      =>  array( 'shipping' => array($_POST["inputShipping"]))
                );
                $return .= (wp_insert_post($source))?"<h2 class='sus'>Заказ успешно добавлен!</h2>":"<h2 class='err'>Не удалось добавить заказ!</h2>";
            }
            $return .= '<form action="" method="post" class="form-horizontal order" id="orderForm">';
            $return .='<div class="form-group">';
            $return .='<label for="inputProduct" class="col-sm-2 control-label">Товар</label>';
            $return .='<div class="col-sm-10">';
            $return .='<select name="inputProduct" class="form-control" id="inputProduct">';
            foreach ($all_posts as $post)
            {
                $return .= '<option>'.$post->post_title.'</option>'; 
            }
            $return .='</select>';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<label for="inputName" class="col-sm-2 control-label">Ваше имя</label>';
            $return .='<div class="col-sm-10">';
            $return .='<input name="inputName" type="text" class="form-control f_name" id="inputName" placeholder="Ваше имя">';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<label for="inputEmail" class="col-sm-2 control-label">Ваше имя</label>';
            $return .='<div class="col-sm-10">';
            $return .='<input name="inputEmail" type="email" class="form-control f_email" id="inputEmail" placeholder="Ваш имейл">';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<label for="inputShipping" class="col-sm-2 control-label">Метод доставки</label>';
            $return .='<div class="col-sm-10">';
            $return .='<select name="inputShipping" class="form-control" id="inputShipping">';
            $return .= '<option>Самовывоз</option>'; 
            $return .= '<option>Доставка почтой</option>'; 
            $return .= '<option>Курьерская доставка</option>'; 
            $return .='</select>';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<div class="col-sm-offset-2 col-sm-10">';            
            $return .='<button type="sybmit" class="btn btn-primary">Заказать</button>';
            $return .='</div>';
            $return .='</div>';
            $return .='</form>';
            $return .='<script src="';
            $return .=get_bloginfo("template_url");
            $return .='/js/validate.js"></script>';
            return $return;
        }
        else
        {
            $return = '<form action="" method="post" class="form-horizontal order" id="orderForm">';
            $return .='<div class="form-group">';
            $return .='<label for="inputProduct" class="col-sm-2 control-label">Товар</label>';
            $return .='<div class="col-sm-10">';
            $return .='<select name="inputProduct" class="form-control" id="inputProduct">';
            foreach ($all_posts as $post)
            {
                $return .= '<option>'.$post->post_title.'</option>'; 
            }
            $return .='</select>';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<label for="inputName" class="col-sm-2 control-label">Ваше имя</label>';
            $return .='<div class="col-sm-10">';
            $return .='<input name="inputName" type="text" class="form-control f_name" id="inputName" placeholder="Ваше имя">';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<label for="inputEmail" class="col-sm-2 control-label">Ваше имя</label>';
            $return .='<div class="col-sm-10">';
            $return .='<input name="inputEmail" type="email" class="form-control f_email" id="inputEmail" placeholder="Ваш имейл">';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<label for="inputShipping" class="col-sm-2 control-label">Метод доставки</label>';
            $return .='<div class="col-sm-10">';
            $return .='<select name="inputShipping" class="form-control" id="inputShipping">';
            $return .= '<option>Самовывоз</option>'; 
            $return .= '<option>Доставка почтой</option>'; 
            $return .= '<option>Курьерская доставка</option>'; 
            $return .='</select>';
            $return .='</div>';
            $return .='</div>';
            $return .='<div class="form-group">';
            $return .='<div class="col-sm-offset-2 col-sm-10">';            
            $return .='<button type="sybmit" class="btn btn-primary">Заказать</button>';
            $return .='</div>';
            $return .='</div>';
            $return .='</form>';
            $return .='<script src="';
            $return .=get_bloginfo("template_url");
            $return .='/js/validate.js"></script>';
            return $return;
        }
        
    }
}