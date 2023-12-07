<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */
 
 /*
		
Template Name: Каталог
Template Post Type: page

*/
	
	

defined( 'ABSPATH' ) || exit;

get_header();
//get_header( 'shop' );
//include 'header.php';

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>


<!-- Header parallax -->
<header class="header-parallax">
	<div class="parallax-2"></div>
	<div class="container"> <!-- container/container-fluid -->
		<div class="row justify-content-center align-items-center" style="min-height: 50vh;"> <!-- min-height: 75vh; -->
			<div class="col-md-8 text-center text-light py-5"> <!-- text-center -->
				<!-- Title -->
				<h1 class="text-uppercase fw-bold mb-3"><?php single_cat_title(); ?> в Рязани</h1>
				<!-- Subtitle -->
				<h2 class="text-uppercase fw-normal mb-5">Готовые и на заказ</h2>
				<!-- Description
				<p class="header-description fw-light mb-4">Версия от 16.08.2021</p> -->
			</div>
		</div>
	</div>
</header>
<!-- /Header parallax -->1


<?php
	$obj = get_queried_object();
	$cat_name = $obj->name;
	
	$query = new WP_Query( array(
		'product_cat' => $cat_name,
		'tax_query' => array(
			array(
				'taxonomy' => 'product_tag',
				'field'    => 'slug', // Поле, по которому ищем термин
				'terms'    => 'витринные-образцы'
			)
		)
	) );
									
	// Считаем кол-во записей
	$posts_count = 0;
	while ( $query->have_posts() ) { $query->the_post();
		$posts_count = $posts_count + 1;
	} wp_reset_postdata();
	
	// Если есть записи для распродажи, то добавляем раздел
	if ( $posts_count != 0 ) { ?>
		<!-- SALE SECTION -->
		<section class="sale-section pt-5 pb-2 bg-white">
			<div class="container shkafy-cupe-section site-section">
				<div class="row">
					<div class="col">
						<h2 class="text-uppercase text-center text-corporation-orange fw-bold mb-5">Распродажа витринных образцов</h2>
					</div>
				</div>
				<div class="row justify-content-center">
					<?php
						// Выводим записи
						while ( $query->have_posts() ) { $query->the_post();				
							$price = number_format( get_post_meta( get_the_ID(), '_regular_price', true), 0, ',', ' ' );
							$sale = number_format( get_post_meta( get_the_ID(), '_price', true), 0, ',', ' ' );
						?>
							<div class="col-md-<?php if ( $posts_count <= 2 ) { echo '6'; } else { echo '4'; } ?> mb-5">
								<div class="approximation<?php if ( $posts_count <= 2 ) { echo ' approximation-lg'; } ?> shadow rounded">
									<a href="<?php echo get_permalink( $product->post->id ); ?>">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
										<div class="card-wrapper">
											<div class="flag">
												<div class="flag-old-price"><?php echo 	$price; ?> руб</div>
												<div class="flag-price"><?php echo $sale; ?> руб</div>
											</div>
											<h2><?php the_title(); ?></h2>
										</div>
									</a>
								</div>
							</div>
						<?php }
					?>
				</div>
			</div>
		</section>
		<!-- END SALE SECTION -->
	<?php }
?>


<section class="bg-light py-5">
<!-- Portfolio -->
	<div class="site-section pb-5">
		<div class="container">
			<!--div class="row">
				<div class="col">
					<h2 class="text-uppercase text-center text-corporation-orange fw-bold">Каталог</h2>
				</div>
			</div-->
			
			<div class="row">
				<div class="col-md-3 mt-5 project-entry">
					
					<nav class="nav flex-column catalog-filter">
						<?php				
							
							$obj = get_queried_object();
							$cat_id = $obj->term_id;
							
							// Определяем радителя текущей категории
							$ancestors = get_ancestors( $cat_id, 'product_cat' );
							$term = get_term( $ancestors[0] );
							
							// Имя родителя текущей категории
							$parent = $term->name;
							
							// ID родителя текущей категории
							$parent_id = $term->term_id;
							
							echo $parent;
							echo $parent_id;
							
							
							
							// Если есть родитель, то...
							if ( $parent ) {
								
								// Выводим в меню родительскую категорию
								//$cat_name = $obj->name;
								//$cat_id = $obj->term_id;
								echo '<a href="'.get_category_link( $parent_id ).'" class="nav-link">Все '.$parent.'</a>';
								
								$args = [
									'taxonomy'      => [ 'product_cat' ],
									'orderby'       => 'menu_order', // Сортировка как в админке
									'order'         => 'ASC',
									'hide_empty'    => true,
									'object_ids'    => null,
									'include'       => array(),
									'exclude'       => array(),
									'exclude_tree'  => array(),
									'number'        => '',
									'fields'        => 'all',
									'count'         => false,
									'slug'          => '',
									'parent'         => '',
									'hierarchical'  => true,
									'child_of'      => $parent_id,
									'get'           => '', // ставим all чтобы получить все термины
									'name__like'    => '',
									'pad_counts'    => false,
									'offset'        => '',
									'search'        => '',
									'cache_domain'  => 'core',
									'name'          => '',    // str/arr поле name для получения термина по нему. C 4.2.
									'childless'     => true, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
									'update_term_meta_cache' => true, // подгружать метаданные в кэш
									'meta_query'    => '',
								];

								$terms = get_terms( $args );

								foreach ( $terms as $term ) { ?>
									<a href="<?php echo get_category_link( $term->term_id ); ?>" class="nav-link"><?php echo $term->name; ?></a>
								<?php }
							
							// Если нет родителя, то ...
							} else {
								
								// Выводим в меню родительскую категорию
								$cat_name = $obj->name;
								$cat_id = $obj->term_id;
								echo '<a href="'.get_category_link( $cat_id ).'" class="nav-link">Все '.$cat_name.'</a>';
								
								$args = [
									'taxonomy'      => [ 'product_cat' ],
									'orderby'       => 'menu_order', // Сортировка как в админке
									'order'         => 'ASC',
									'hide_empty'    => true,
									'object_ids'    => null,
									'include'       => array(),
									'exclude'       => array(),
									'exclude_tree'  => array(),
									'number'        => '',
									'fields'        => 'all',
									'count'         => false,
									'slug'          => '',
									'parent'         => '',
									'hierarchical'  => true,
									'child_of'      => $cat_id,
									'get'           => '', // ставим all чтобы получить все термины
									'name__like'    => '',
									'pad_counts'    => false,
									'offset'        => '',
									'search'        => '',
									'cache_domain'  => 'core',
									'name'          => '',    // str/arr поле name для получения термина по нему. C 4.2.
									'childless'     => true, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
									'update_term_meta_cache' => true, // подгружать метаданные в кэш
									'meta_query'    => '',
								];

								$terms = get_terms( $args );

								foreach ( $terms as $term ) { ?>
									<a href="<?php echo get_category_link( $term->term_id ); ?>" class="nav-link"><?php echo $term->name; ?></a>
								<?php }
							}
							
						?>
					</nav>
				</div>
				<div class="col-md-9">
					<div class="row">
					
						
						<?php
							if ( woocommerce_product_loop() ) {

								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked woocommerce_output_all_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								//do_action( 'woocommerce_before_shop_loop' );

								woocommerce_product_loop_start();

								if ( wc_get_loop_prop( 'total' ) ) {;
									
									global $query_string;
									// Добавляем базовые параметры в массив $query_string_args
									parse_str( $query_string, $query_string_args );
									// Добавляем параметры в новый массив
									$query_string_args[ 'order' ] = 'ASC';
									$query_string_args[ 'orderby' ] = 'menu_order';
									// Не выводим продукты, которые имеют тэги 'витринные-образцы'
									$query_string_args[ 'tax_query' ] = array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'product_tag',
											'field'    => 'slug',
											'terms'    => 'витринные-образцы',
											'operator' => 'NOT IN'
										)
									);
									
									query_posts( $query_string_args );
									
									while ( have_posts() ) { the_post();

										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action( 'woocommerce_shop_loop' );

										wc_get_template_part( 'content', 'product' );
									}
									wp_reset_query();
								}

								woocommerce_product_loop_end();

								/**
								 * Hook: woocommerce_after_shop_loop.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								//do_action( 'woocommerce_after_shop_loop' );
							} else {
								/**
								 * Hook: woocommerce_no_products_found.
								 *
								 * @hooked wc_no_products_found - 10
								 */
								//do_action( 'woocommerce_no_products_found' );
							}

							/**
							 * Hook: woocommerce_after_main_content.
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							//do_action( 'woocommerce_after_main_content' );

							/**
							 * Hook: woocommerce_sidebar.
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							//do_action( 'woocommerce_sidebar' );

							//get_footer( 'shop' );
								
							?>
		
						
						
					</div>
				</div>
			 </div>
		</div>
	</div>
	<!-- Portfolio -->
</section>


<section class="bg-white">
	<div class="container"> <!-- container/container-fluid -->
		<div class="row justify-content-center">
			<div class="col-md-8" style="position: relative;">
				<img src="<?php echo get_template_directory_uri(); ?>/images/order-img-2.png" class="d-none d-md-block" style="max-width: 350px; position: absolute; bottom: 0; left: -50px;">
				<div class="row">
					<div class="col-md-6 offset-md-6 py-5 my-0 my-md-3 text-dark">
						<h3 class="text-uppercase text-yellow mb-3">Не нашли подходящего дизайна кухни или корпусной мебели?</h3>
						<p>Не расстраивайтесь! Свяжитесь с нами любым удобным для Вас способом и наш дизайнер создаст для Вас дизайн кухни или другой корпусной мебели Вашей мечты <strong>абсолютно бесплатно!</strong></p>
						<button class="btn btn-lg btn-corporation-orange px-5 text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">Оставить заявку</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Portfolio section 2 -->
<div id="sp-portfolio" class="scroll-points"></div>
<section class="bg-light py-5">
	<div class="container pb-2">
		<div class="row">
			<div class="col">
				<h2 class="text-uppercase text-center text-corporation-orange fw-bold mb-5">Вот некоторые наши работы</h2>
			</div>
		</div>
		
		<!-- Include if used different types of portfolio
		<div class="row mb-5 d-none d-md-block">
			<div class="col">
				<ul class="nav justify-content-center" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Все наши работы</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Шкафы-купе</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Гардеробные</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row mb-5 d-md-none">
			<div class="col">						
				<select id="portfolioSelect" class="form-select" onchange="funcOnOffDiv();">
					<option value="home" selected>Все наши работы</option>
					<option value="profile">Шкафы-купе</option>
					<option value="contact">Гардеробные</option>
				</select>
				<script>
					function funcOnOffDiv() {
						var option = document.getElementById('portfolioSelect').value;
						if ( option == 'home' ) {
							document.getElementById('home').classList.add('active', 'show');
							document.getElementById('profile').classList.remove('active', 'show');;
							document.getElementById('contact').classList.remove('active', 'show');
						} else if ( option == 'profile' ) {
							document.getElementById('home').classList.remove('active', 'show');
							document.getElementById('profile').classList.add('active', 'show');
							document.getElementById('contact').classList.remove('active', 'show');
						} else if (option == 'contact') {
							document.getElementById('home').classList.remove('active', 'show');
							document.getElementById('profile').classList.remove('active', 'show');
							document.getElementById('contact').classList.add('active', 'show');
						}
					}
				</script>
			</div>
		</div> -->
		
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner rounded shadow">
						
						<?php
						
							// Получаем название текущей категории
							$obj = get_queried_object();
							$cat_name = $obj->name;
							//echo $cat_name;
							$post = get_page_by_title( $cat_name, $output , 'portfolio' );
							$post_id =  $post->ID;
							
							
							
							if ( $post_id ) {
								$images = get_post_gallery_images( $post_id );
								$count2 = false;
								foreach ( $images as $image ) {
									if ( $count == false ) { ?>
										<div class="carousel-item h-100 active">
											<div class="row align-items-center h-100">
												<div class="col text-center">
													<img src="<?php echo $image; ?>" class="img-fluid" style="max-width: 75vw; max-height: 75vh;" alt="...">
												</div>
											</div>
										</div>
									<?php $count = true; } else { ?>
										<div class="carousel-item h-100">
											<div class="row align-items-center h-100">
												<div class="col text-center">
													<img src="<?php echo $image; ?>" class="img-fluid" style="max-width: 75vw; max-height: 75vh;" alt="...">
												</div>
											</div>
										</div>	
									<?php }	
								}
							} else {
								echo '<div class="row align-items-center" style="height: 25vh;"><div class="col text-center">В данной категории наши работы еще не добавлены. Приносим извинения за доставленные неудобства.</div></div>';
							}
						?>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
						<span class="carousel-control-prev-icon" style="height: 3.5rem;" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
						<span class="carousel-control-next-icon" style="height: 3.5rem;" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</div>
		<!--div class="row d-md-none">
			<div class="col text-center">
				<button type="button" id="caruoselOrderButton" class="btn btn-danger rounded-pill d-md-none px-3 mt-5" style="transition: .5s;" data-bs-toggle="modal" data-bs-target="#exampleModal">Хочу такой же</button>
			</div>
		</div-->
	</div>
</section>
<!-- /Portfolio section 2 -->


<!-- Action -->
<section class="action-4-section bg-white py-5">
	<div class="container"> <!-- container/container-fluid -->
		<div class="row justify-content-center">
			<div class="col">
				<h2 class="text-uppercase text-center text-corporation-orange fw-bold">Акции и скидки</h2>
				<div class="row justify-content-around">
					<div class="col-md-6 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/besplatnaya-dostavka-i-ustanovka.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light">При заказе корпусной мебели - доставка и&#160;сборка <strong>БЕСПЛАТНО!</strong></p>
					</div>
				</div>
				<div class="row justify-content-around">
					<div class="col-md-4 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/action-1.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light">При заказе кухни - честная <strong>скидка &#160;5%!</strong> при 100% оплате.</p>
					</div>
					<div class="col-md-4 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/action-melkaya-bytovay-technics.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light">При заказе кухни от 50 000 рублей - мелкая бытовая техника <strong>в&#160;подарок!</strong></p>
					</div>
					<div class="col-md-4 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/action-5.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light">Нашим клиентам <strong>оплачиваем парковку</strong> в&#160;ТЦ&#160;"Малина"</p>
					</div>
					<div class="col-md-4 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/action-4.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light">При заказе кухни <strong>скидка до&#160;35%!</strong></p>
					</div>
					<div class="col-md-4 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/action-6.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light">При заказе шкафа-купе <strong>скидка до&#160;30%</strong> и <strong>стол в&#160;подарок!</strong></p>
					</div>
					<div class="col-md-4 mt-5">
						<img src="<?php echo get_template_directory_uri(); ?>/images/actions/action-3.jpg" class="w-100 mb-4 rounded shadow">
						<p class="fs-5 fw-light"><strong>Дополнительная скидка&#160;5%</strong> за 100% предоплату, молодожёнам и новосёлам, иногородним, пенсионерам, в день рождения и юбилей (скидки распростроняются на все кухонные гарнитуры).</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Action -->


<?php
	
	//include 'footer.php';
	//get_footer( 'shop' );
	get_footer();
?> 