<?php get_header(); ?>
<?php
$class_list = array(
        "hex col-sm-6",
        "hex col-sm-6",
        "hex col-sm-6  templatemo-hex-top2",
        "hex col-sm-6  templatemo-hex-top3",
        "hex col-sm-6  templatemo-hex-top3",
        "hex col-sm-6 hex-offset templatemo-hex-top1 templatemo-hex-top2",
        "hex col-sm-6 templatemo-hex-top1 templatemo-hex-top3",
        "hex col-sm-6 templatemo-hex-top1  templatemo-hex-top3",
        "hex col-sm-6 templatemo-hex-top1  templatemo-hex-top2"   
);
$conteiner_class_list = array(
        "container",
        "container answer_list templatemo_gallerytop"
);
$all_posts = get_posts(array(
        'numberposts'     => -1,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_type'       => 'products',
        'post_status'     => 'publish'
)); 
?>
<div id="menu-container">
    <div class="content homepage" id="menu-1">
        <?php for ($j=0;$j<count($all_posts);$j+=9):
            $posts = get_posts(array(
                    'numberposts'     => 9,
                    'offset'          => $j, 
                    'orderby'         => 'post_date',
                    'order'           => 'DESC',
                    'post_type'       => 'products',
                    'post_status'     => 'publish'
            )); 
            ?>
        <div class="<?php echo (!$j)?$conteiner_class_list[$j]:$conteiner_class_list[1];?>">
            <div class="row templatemorow">
                <?php $i=0; foreach($posts as $post): setup_postdata($post); ?>
                <div class="<?php echo $class_list[$i]?>">
                    <div>
                        <div class="hexagon hexagon2 gallery-item">
                            <div class="hexagon-in1">
                                <div class="hexagon-in2">
                                    <div class="overlay">
                                        <a href="<?php the_permalink(); ?>" data-rel="lightbox" class="fa fa-expand">
                                            <h2><?php the_title(); ?></h2>
                                            <?php the_content(); ?>
                                            
                                        </a> 
                                        <a class="btn btn-primary" href="<?php the_permalink(); ?>" role="button">Заказать</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php ($i<=7) ? $i++ : $i=0;endforeach;?>
            </div>
        </div> 
        <?php endfor;?>
        <?php wp_reset_postdata(); ?>
    </div>
    <div class="clear"></div>
</div>
<?php get_footer(); ?>

