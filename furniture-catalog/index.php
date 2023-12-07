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
	
	Template Name: Главная
	Template Post Type: page
	
*/
	
defined( 'ABSPATH' ) || exit;

//get_header( 'shop' );
//include 'header.php';
get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>


<!-- Header 1 -->
<div id="sp-home" class="scroll-points"></div>
<header class="bg-secondary" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/header-bg.jpg);">
	<div class="container"> <!-- container/container-fluid -->
		<div class="row justify-content-center align-items-center" style="min-height: 75vh;"> <!-- min-height: 50vh; -->
			<div class="col text-light py-5"> <!-- text-center -->
				<!-- Title
				<h1 class="text-uppercase text-center fw-bold mb-4">Готовая корпусная мебель в&nbspРязани от&nbspизвестных отечественных производителей</h1> -->
				<!-- Subtitle
				<h2 class="text-uppercase header-subtitle">И собственное производство по&nbspиндивидуальным размерам></h2> -->
				
				<!-- Title -->
				<h1 class="text-uppercase fw-bold mb-4" style="max-width: 850px;">Кухни, шкафы и другая корпусная мебель в Рязани</h1>
				<!-- Subtitle -->
				<h2 class="header-subtitle" style="text-align: left; margin-left: 0;">Готовая и на заказ по&nbspиндивидуальным размерам, собственного производства и от&nbspизвестных отечественных производителей.</h2>
				<a href="#quiz-sp" type="button" class="btn btn-lg btn-corporation-orange" style="margin-top: 40px;">Рассчитать стоимость</a>
			</div>
		</div>
	</div>
</header>
<!-- /Header 1 -->





<section class="bg-light py-5">
<!-- Portfolio -->
	<div class="site-section pb-3">
		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="text-uppercase text-center text-corporation-orange fw-bold">Каталог</h2>
				</div>
			</div>
			
			<div class="row justify-content-center">
				<?php
					$terms = get_terms( array(
						'taxonomy' => 'product_cat',
						'hide_empty' => true,
						'pad_counts'=> true,
						'orderby' => 'menu_order',
						'parent' => 0
					) );
					if($terms) :
						foreach($terms as $term) : ?>
							<div class="col-lg-4 col-md-6 mt-5 project-entry">
								<h3 class="mb-3">
									<?php echo $term->name;?>
									<span class="fw-light">(<?php if ($term->count > 0) : ?><?php echo $term->count; ?><?php else: ?>0<?php endif; ?>)</span>
								</h3>
								<a class="subcategory-image" href="<?php echo get_term_link($term->term_id);?>">
									<div class="d-block figure rounded shadow" style="" onClick="galleryOn('num1');">
										<?php woocommerce_subcategory_thumbnail( $term );  ?>
									</div>
								</a>
							</div>
						<?php endforeach;
					endif;
				?>
			</div>
		</div>
	</div>
	<!-- Portfolio -->
</section>


<!-- Portfolio section 2 -->
<div id="sp-portfolio" class="scroll-points"></div>
<section class="bg-white py-5">
	<div class="container pb-2">
		<div class="row">
			<div class="col">
				<h2 class="text-uppercase text-center text-corporation-orange fw-bold mb-5">Некоторые наши работы</h2>
			</div>
		</div>

		<div class="row justify-content-center align-items-center">
			<div class="col-md-10">
				<div id="homePagePortfolio" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner m-auto">
						<?php
							// 'title' => 'Разное' можно удалить, тогда портфолио будет показываться из разных разделов.
							$query = new WP_Query( [ 'post_type' => 'portfolio', 'title' => 'Разное'] );
							while ( $query->have_posts() ) { $query->the_post();
								$images = get_post_gallery_images();
								$first = true;
								foreach ( $images as $image ) {
									$image_id = attachment_url_to_postid( $image );
									if ( $first == true ) { ?>
										<div class="carousel-item active" data-bs-interval="100000">
											<img src="<?php echo $image; ?>" class="rounded shadow" alt="...">
											<?php if ( wp_get_attachment_caption( $image_id ) != '' ) { ?>
												<div class="carousel-caption d-none d-md-block">
													<!--h5>Title</h5-->
													<p class="text-center mb-0"><?php echo wp_get_attachment_caption( $image_id ); ?></p>
												</div>
											<?php } ?>
										</div>
									<?php $first = false; } else { ?>
										<div class="carousel-item" data-bs-interval="100000">
											<img src="<?php echo $image; ?>" class="rounded shadow" alt="...">
											<?php if ( wp_get_attachment_caption( $image_id ) != '' ) { ?>
												<div class="carousel-caption d-none d-md-block">
													<!--h5>Title</h5-->
													<p class="text-center mb-0"><?php echo wp_get_attachment_caption( $image_id ); ?></p>
												</div>
											<?php } ?>
										</div>
									<?php }
								}
							}
						?>
						
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#homePagePortfolio"  data-bs-slide="prev">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-left.png">
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#homePagePortfolio"  data-bs-slide="next">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/arrow-right.png">
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Portfolio section 2 -->


<!-- Action -->
<section class="action-4-section bg-light py-5">
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
				<div class="row justify-content-around">
					<div class="col-md-4 mt-4 text-center">
						<a href="http://1001i1kuhnya.ru/акции-и-скидки/" class="btn btn-lg btn-corporation-orange px-5 text-light" type="button">Смотреть все акции</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Action -->


<!-- Section Quiz -->
<div id="quiz-sp" class="scroll-points"></div>
<section id="quiz" class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col">
				<h2 class="text-uppercase text-center text-corporation-orange fw-bold">Ответьте на несколько вопросов ниже<br>и узнайте предварительную стоимость Вашей мебели</h2>
				<div class="title-line mb-5"></div>
				<div class="row justify-content-center">
			
					<!--  ПЕРВЫЙ ОБЩИЙ ВОПРОС -->
					<div class="col-12" id="1">
						<h3 class="text-center mb-5"><!--span class="me-2" style="color: #A5A5A5;">1/7</span-->Какая мебель Вас интересует?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-1-1">
									<input type="radio" id="answer-1-1" name="quostion-1" class="checkbox" value="Кухня">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/1-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Кухня</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-1-2">
									<input type="radio" id="answer-1-2" name="quostion-1" class="checkbox" value="Шкаф или гардеробная">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/1-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Шкаф или гардеробная</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-1-3">
									<input type="radio" id="answer-1-3" name="quostion-1" class="checkbox" value="Другая корпусная мебель">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/1-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Другая корпусная мебель</h3>
							</div>
						</div>
						<div class="row">
							<div class="col text-center">
								<input type="button" value="Далее" class="btn btn-corporation-orange" style="width: 175px;" onclick="nextQuostion( '1' );">
							</div>
						</div>
					</div>
					<!--  /ПЕРВЫЙ ОБЩИЙ ВОПРОС -->
					
					
					<!-- ВОПРОСЫ ПО КУХНЯМ -->
					<div class="col-12" id="2-1" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">2/7</span>Какая планировка кухни Вам нужна?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-1-1">
									<input type="radio" id="answer-2-1-1" name="quostion-2-1" class="checkbox" value="Прямая">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-1-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Прямая</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-1-2">
									<input type="radio" id="answer-2-1-2" name="quostion-2-1" class="checkbox" value="Угловая">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-1-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Угловая</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-1-3">
									<input type="radio" id="answer-2-1-3" name="quostion-2-1" class="checkbox" value="П-образная">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-1-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">П-образная</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-1-4">
									<input type="radio" id="answer-2-1-4" name="quostion-2-1" class="checkbox" value="С островком">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-1-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">С островком</h3>
							</div>
							<!--div class="col-2">
								<label class="option_item mb-3" for="answer-2-1-5">
									<input type="radio" id="answer-2-1-5" name="quostion-2-1" class="checkbox" value="Пока не знаю">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-1-5.jpg" style="width: 100%;">
									</div>
								</label>
								<h3>Пока не знаю</h3>
							</div-->
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '2-1' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '2-1' );">
							</div>
						</div>
					</div>
					
					<!-- Один размер -->
					<div class="col-md-6" id="3-1-1" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">3/7</span>Укажите размеры</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-md-4">
								<label for="answer-3-1-1" class="form-label">Длинна 1, м</label>
								<input type="text" class="form-control" id="answer-3-1-1-1" name="quostion-3-1-1">
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '3-1-1' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '3-1-1' );">
							</div>
						</div>
					</div>
					
					<!-- Два размера -->
					<div class="col-md-6" id="3-1-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">3/7</span>Укажите размеры</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-md-4">
								<label for="answer-3-1-1" class="form-label">Длинна 1, м</label>
								<input type="text" class="form-control" id="answer-3-1-1-2" name="quostion-3-1-2">
							</div>
							<div class="col-md-4">
								<label for="answer-3-1-2" class="form-label">Длинна 2, м</label>
								<input type="text" class="form-control" id="answer-3-1-2-2" name="quostion-3-1-2">
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '3-1-2' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '3-1-2' );">
							</div>
						</div>
					</div>
					
					<!-- Три размера -->
					<div class="col-md-6" id="3-1-3" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">3/7</span>Укажите размеры</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-md-4">
								<label for="answer-3-1-1" class="form-label">Длинна 1, м</label>
								<input type="text" class="form-control" id="answer-3-1-1-3" name="quostion-3-1-2">
							</div>
							<div class="col-md-4">
								<label for="answer-3-1-2" class="form-label">Длинна 2, м</label>
								<input type="text" class="form-control" id="answer-3-1-2-3" name="quostion-3-1-2">
							</div>
							<div class="col-md-4">
								<label for="answer-3-1-3" class="form-label">Длинна 3, м</label>
								<input type="text" class="form-control" id="answer-3-1-3-3" name="quostion-3-1-2">
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '3-1-3' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '3-1-3' );">
							</div>
						</div>
					</div>
					
					<!-- Четыре размера -->
					<div class="col-md-6" id="3-1-4" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">3/7</span>Укажите размеры в метрах</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-md-3">
								<label for="answer-3-1-1" class="form-label">Длинна 1</label>
								<input type="text" class="form-control" id="answer-3-1-1-4" name="quostion-3-1-2">
							</div>
							<div class="col-md-3">
								<label for="answer-3-1-2" class="form-label">Длинна 2</label>
								<input type="text" class="form-control" id="answer-3-1-2-4" name="quostion-3-1-2">
							</div>
							<div class="col-md-3">
								<label for="answer-3-1-3" class="form-label">Длинна 3</label>
								<input type="text" class="form-control" id="answer-3-1-3-4" name="quostion-3-1-2">
							</div>
							<div class="col-md-3">
								<label for="answer-3-1-4" class="form-label">Длинна островка</label>
								<input type="text" class="form-control" id="answer-3-1-4-4" name="quostion-3-1-2">
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '3-1-4' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '3-1-4' );">
							</div>
						</div>
					</div>
					
					<!-- 4/7 -->
					<div class="col-12" id="4-1" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">4/7</span>Какой стиль кухни Вы рассматриваете?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-4-1-1">
									<input type="radio" id="answer-4-1-1" name="quostion-4-1" class="checkbox" value="Современный">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/4-1-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Современный</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-4-1-2">
									<input type="radio" id="answer-4-1-2" name="quostion-4-1" class="checkbox" value="Классический">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/4-1-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Классический</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-4-1-3">
									<input type="radio" id="answer-4-1-3" name="quostion-4-1" class="checkbox" value="Лофт">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/4-1-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Лофт</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-4-1-4">
									<input type="radio" id="answer-4-1-4" name="quostion-4-1" class="checkbox" value="Пока не знаю, нужна консультация">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/4-1-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Пока не знаю, нужна консультация</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '4-1' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '4-1' );">
							</div>
						</div>
					</div>
					
					<!-- 5/7 -->
					<div class="col-12" id="5-1" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">5/7</span>Какой материал фасада кухни Вы хотите?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-1-1">
									<input type="radio" id="answer-5-1-1" name="quostion-5-1" class="checkbox" value="ЛДСП/ЛМДФ">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-1-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">ЛДСП</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-1-2">
									<input type="radio" id="answer-5-1-2" name="quostion-5-1" class="checkbox" value="Пленка">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-1-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">МДФ ПВХ (пленка)</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-1-3">
									<input type="radio" id="answer-5-1-3" name="quostion-5-1" class="checkbox" value="Эмаль">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-1-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Эмаль, шпон</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-1-4">
									<input type="radio" id="answer-5-1-4" name="quostion-5-1" class="checkbox" value="Пластик">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-1-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Пластик</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-1-5">
									<input type="radio" id="answer-5-1-5" name="quostion-5-1" class="checkbox" value="Массив">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-1-5.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">AGT</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-1-6">
									<input type="radio" id="answer-5-1-6" name="quostion-5-1" class="checkbox" value="Пока не знаю, нужна консультация">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-1-6.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Пока не знаю, нужна консультация</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '5-1' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '5-1' );">
							</div>
						</div>
					</div>
					
					<!-- 6/7 -->
					<div class="col-12" id="6-1" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">6/7</span>Какой подарок Вы хотите получить в случае заказа?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-1-1">
									<input type="radio" id="answer-6-1-1" name="quostion-6-1" class="checkbox" value="Скидка 10%">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-1-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Скидка 10%</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-1-2">
									<input type="radio" id="answer-6-1-2" name="quostion-6-1" class="checkbox" value="Беспроцентная рассрочка на 6 месяцев">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-1-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Беспроцентная рассрочка на 6 месяцев</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-1-3">
									<input type="radio" id="answer-6-1-3" name="quostion-6-1" class="checkbox" value="Скидка 15% на заказ шкафа в теченее года">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-1-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Скидка 15% на заказ шкафа в теченее года</h3>
							</div>
							<!--div class="col-2">
								<label class="option_item mb-3" for="answer-6-1-4">
									<input type="radio" id="answer-6-1-4" name="quostion-6-1" class="checkbox" value="С островком">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-1-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3>Пластик</h3>
							</div-->
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '6-1' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '6-1' );">
							</div>
						</div>
					</div>
					
					<!-- 7/1 -->
					<div class="col-md-6" id="7-1" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">7/7</span>Введите Ваши контакты</h3>
						<form method="post" action="<?php echo get_template_directory_uri(); ?>/mails/get_calculate_kitchen.php">
							<div class="row justify-content-center">
								<div class="col-md-4">
									<label for="exampleFormControlInput1" class="form-label">Ваше имя</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" name="name">
								</div>
								<div class="col-md-4">
									<label for="exampleFormControlInput2" class="form-label">Ваш телефон</label>
									<input type="text" class="form-control telMask" id="exampleFormControlInput2" name="phone" required>
								</div>
							</div>
							<div class="row">
								<div class="col text-center" style="margin-top: 45px;">
									<input type="hidden" id="answer1-1" name="answer1">
									<input type="hidden" id="answer2-1" name="answer2">
									<input type="hidden" id="answer3-1-1" name="answer3-1">
									<input type="hidden" id="answer3-1-2" name="answer3-2">
									<input type="hidden" id="answer3-1-3" name="answer3-3">
									<input type="hidden" id="answer3-1-4" name="answer3-4">
									<input type="hidden" id="answer4-1" name="answer4">
									<input type="hidden" id="answer5-1" name="answer5">
									<input type="hidden" id="answer6-1" name="answer6">
									<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '7-1' );">
									<input type="submit" class="btn btn-corporation-orange" value="Отправить">
								</div>
							</div>
						</form>
					</div>
					<!-- /ВОПРОСЫ ПО КУХНЯМ -->
					
					
					<!-- ВОПРОСЫ ПО ШКАФАМ -->
					<div class="col-12" id="2-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">2/7</span>Какой тип шкафа Вам нужен?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-2-1">
									<input type="radio" id="answer-2-2-1" name="quostion-2-2" class="checkbox" value="Корпусный">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-2-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Корпусный</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-2-2">
									<input type="radio" id="answer-2-2-2" name="quostion-2-2" class="checkbox" value="Встроенный">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-2-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Встроенный</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-2-3">
									<input type="radio" id="answer-2-2-3" name="quostion-2-2" class="checkbox" value="Угловой">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-2-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Угловой</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-2-4">
									<input type="radio" id="answer-2-2-4" name="quostion-2-2" class="checkbox" value="Радиусный">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-2-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Радиусный</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-2-5">
									<input type="radio" id="answer-2-2-5" name="quostion-2-2" class="checkbox" value="Гардеробный">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-2-5.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Гардеробный</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-2-2-6">
									<input type="radio" id="answer-2-2-6" name="quostion-2-2" class="checkbox" value="Пока не знаю">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/2-2-6.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Пока не знаю</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '2-2' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '2-2' );">
							</div>
						</div>
					</div>
					
					<div class="col-12" id="3-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">3/7</span>Какой материал фасада шкафа Вы хотите?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-3-2-1">
									<input type="radio" id="answer-3-2-1" name="quostion-3-2" class="checkbox" value="ЛДСП">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/3-2-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">ЛДСП</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-3-2-2">
									<input type="radio" id="answer-3-2-2" name="quostion-3-2" class="checkbox" value="Пескоструй">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/3-2-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Пескоструй</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-3-2-3">
									<input type="radio" id="answer-3-2-3" name="quostion-3-2" class="checkbox" value="Зеркало">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/3-2-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Зеркало</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-3-2-4">
									<input type="radio" id="answer-3-2-4" name="quostion-3-2" class="checkbox" value="Фотопечать">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/3-2-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Фотопечать</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-3-2-5">
									<input type="radio" id="answer-3-2-5" name="quostion-3-2" class="checkbox" value="Комбинированный">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/3-2-5.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Комбинированный</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-3-2-6">
									<input type="radio" id="answer-3-2-6" name="quostion-3-2" class="checkbox" value="Пока не знаю">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/3-2-6.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Пока не знаю, нужна консультация</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '3-2' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '3-2' );">
							</div>
						</div>
					</div>
					
					<div class="col-12" id="4-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">4/7</span>Какая ориентировочная ширина шкафа планируется?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-1">
									<input type="radio" id="answer-4-2-1" name="quostion-4-2" class="checkbox" value="1">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">1 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-2">
									<input type="radio" id="answer-4-2-2" name="quostion-4-2" class="checkbox" value="1,5">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">1,5</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-3">
									<input type="radio" id="answer-4-2-3" name="quostion-4-2" class="checkbox" value="2">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">2 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-4">
									<input type="radio" id="answer-4-2-4" name="quostion-4-2" class="checkbox" value="2,5">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">2,5 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-5">
									<input type="radio" id="answer-4-2-5" name="quostion-4-2" class="checkbox" value="3">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">3</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-6">
									<input type="radio" id="answer-4-2-6" name="quostion-4-2" class="checkbox" value="3,5">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">3,5 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-7">
									<input type="radio" id="answer-4-2-7" name="quostion-4-2" class="checkbox" value="4">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">4 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-8">
									<input type="radio" id="answer-4-2-8" name="quostion-4-2" class="checkbox" value="4,5">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">4,5 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-9">
									<input type="radio" id="answer-4-2-9" name="quostion-4-2" class="checkbox" value="5">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">5 м</h3>
							</div>
							<div class="col-3 col-md-1">
								<label class="option_item mb-3" for="answer-4-2-10">
									<input type="radio" id="answer-4-2-10" name="quostion-4-2" class="checkbox" value=">5">
									<div class="option_inner">
										<div class="shadow-wrapper-box"></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/ico/check-background.svg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">>5 м</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '4-2' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '4-2' );">
							</div>
						</div>
					</div>
					
					<div class="col-12" id="5-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">5/7</span>Какое количество дверей Вы предполагаете?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-2-1">
									<input type="radio" id="answer-5-2-1" name="quostion-5-2" class="checkbox" value="1 дверь">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-2-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">1 дверь</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-2-2">
									<input type="radio" id="answer-5-2-2" name="quostion-5-2" class="checkbox" value="2 двери">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-2-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">2 двери</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-2-3">
									<input type="radio" id="answer-5-2-3" name="quostion-5-2" class="checkbox" value="3 двери">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-2-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">3 двери</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-2-4">
									<input type="radio" id="answer-5-2-4" name="quostion-5-2" class="checkbox" value="4 двери">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-2-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">4 двери</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-2-5">
									<input type="radio" id="answer-5-2-5" name="quostion-5-2" class="checkbox" value="5 дверей">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-2-5.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">5 дверей</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-5-2-6">
									<input type="radio" id="answer-5-2-6" name="quostion-5-2" class="checkbox" value="Более 5 дверей">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/5-2-6.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Более 5 дверей</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '5-2' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '5-2' );">
							</div>
						</div>
					</div>
					
					<div class="col-12" id="6-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">6/7</span>Какой подарок Вы хотите получить в случае заказа?</h3>
						<div class="row justify-content-md-center mb-5">
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-2-1">
									<input type="radio" id="answer-6-2-1" name="quostion-6-2" class="checkbox" value="Скидка 15%">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-2-1.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Скидка 15%</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-2-2">
									<input type="radio" id="answer-6-2-2" name="quostion-6-2" class="checkbox" value="Беспроцентная рассрочка на 6 месяцев">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-2-2.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Беспроцентная рассрочка на 6 месяцев</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-2-3">
									<input type="radio" id="answer-6-2-3" name="quostion-6-2" class="checkbox" value="Бесплатная доставка и установка">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-2-3.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Бесплатная доставка и установка</h3>
							</div>
							<div class="col-6 col-md-2">
								<label class="option_item mb-3" for="answer-6-2-4">
									<input type="radio" id="answer-6-2-4" name="quostion-6-2" class="checkbox" value="Скидка 10% на заказ кухни в теченее года">
									<div class="option_inner">
										<div class="shadow-wrapper"><div class="shadow-wrapper-decoration"></div></div>
										<img src="<?php echo get_template_directory_uri(); ?>/images/quiz-new/6-2-4.jpg" style="width: 100%;">
									</div>
								</label>
								<h3 class="mb-3 mb-md-0">Скидка 10% на заказ кухни в теченее года</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col text-center" style="margin-top: 35px;">
								<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '6-2' );">
								<input type="button" value="Далее" class="btn btn-corporation-orange" onclick="nextQuostion( '6-2' );">
							</div>
						</div>
					</div>
					
					<div class="col-md-6" id="7-2" style="display: none;">
						<h3 class="text-center mb-5"><span class="me-2" style="color: #A5A5A5;">7/7</span>Введите Ваши контакты</h3>
						<form method="post" action="<?php echo get_template_directory_uri(); ?>/mails/get_calculate_closet.php">
							<div class="row justify-content-center">
								<div class="col-md-4">
									<label for="exampleFormControlInput1" class="form-label">Ваше имя</label>
									<input type="text" class="form-control" id="exampleFormControlInput1" name="name">
								</div>
								<div class="col-md-4">
									<label for="exampleFormControlInput2" class="form-label">Ваш телефон</label>
									<input type="text" class="form-control telMask" id="exampleFormControlInput2" name="phone" required>
								</div>
							</div>
							<div class="row">
								<div class="col text-center" style="margin-top: 45px;">
									<input type="hidden" id="answer1-2" name="answer1">
									<input type="hidden" id="answer2-2" name="answer2">
									<input type="hidden" id="answer3-2" name="answer3">
									<input type="hidden" id="answer4-2" name="answer4">
									<input type="hidden" id="answer5-2" name="answer5">
									<input type="hidden" id="answer6-2" name="answer6">
									<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '7-2' );">
									<input type="submit" class="btn btn-corporation-orange" value="Отправить">
								</div>
							</div>
						</form>
					</div>
					<!-- /ВОПРОСЫ ПО ШКАФАМ -->
					
					
					<!-- ВЛПРОСЫ ПО ДРУГОЙ МЕБЕЛИ -->
					<div class="col-12" id="2-3" style="display: none;">
						<h3 class="text-center mb-5">Для расчета стоимости опишите Ваше изделие</h3>
						<form method="post" action="<?php echo get_template_directory_uri(); ?>/mails/get_calculate.php" enctype="multipart/form-data">
							<div class="row justify-content-center py-2">
								<div class="col-8 mb-3">
									<textarea type="text" rows="3" name="mes" class="form-control form-control-corporate-color-1" placeholder="Опишите изделие своими словами, укажите размеры, материалы и другую информацию"></textarea>
								</div>
								<div class="col-8">
									<p>Прикрепите изображение изделия или схематично нарисованный Вами рисунок.</p>
								</div>
								<div class="col-8 mb-3">
									<div class="input-group custom-file-button">
										<label class="input-group-text" for="inputGroupFile">Прикрепить</label>
										<input type="file" name="mail_file" accept=".jpg,.jpeg,.png,.pdf,.heic" class="form-control" id="inputGroupFile">
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-4 mb-3">
									<input type="text" name="name" class="form-control form-control-corporate-color-1" placeholder="Ваше имя">
								</div>
								<div class="col-4 mb-3">
									<input type="text" name="tel" class="form-control form-control-corporate-color-1 telMask" placeholder="Ваш телефон*" required="" inputmode="text">
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col text-center" style="margin-top: 35px;">
									<input type="button" value="Назад" class="btn btn-corporate-color-1-outline" onclick="previousQuostion( '2-3' );">
									<input type="submit" value="Отправить" class="btn btn-corporation-orange">
								</div>
							</div>
						</form>
					</div>
					<!-- /ВОПРОСЫ ПО ДРУГОЙ МЕБЕЛИ -->							
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /End section Quiz -->


<!-- About 2 -->
<div id="sp-about-2"></div>
<section id="about" class="bg-light pt-md-3 pb-md-3">
	<div class="container"> <!-- container/container-fluid -->
		<div class="row pt-5">
			<div class="col text-dark">
				<h2 class="text-uppercase text-center text-corporation-orange fw-bold mb-5">О нас</h2>
				<div class="row justify-content-center">
					<div class="col-md-6 pb-5 order-1 order-md-2">
						<img src="<?php echo get_template_directory_uri(); ?>/images/about-img.jpg" class="rounded shadow" style="max-width: 100%;">
					</div>
					<div class="col-md-6 pb-5 order-2 order-md-1">
						<p>Если театр начинается с вешалки, то уют в доме начинается с кухни. Бесспорно, кухня является главной артерией в любой квартире, именно там собираются все жильцы, предвкушая очередной приятный вечер. Подумайте о своей кухне! Наверняка, её образ навевает вам самые теплые воспоминания о вечерах, проведенных в её объятиях за чашечкой кофе с друзьями, а быть может, вы вспоминаете шумную семейную вечеринку, с тортами, искренними пожеланиями и родными улыбками, а, возможно, вы любите проводить время наедине с собой и наслаждаетесь каждой минутой, проведенной в своих мыслях с горячим шоколадом в руках. Так или иначе, образ кухни диктует дизайн. И если ваши мечты об идеальной кухне ещё не сбылись, то магазин 1001 и 1 кухня — это самый подходящим проводником в мир реализации ваших фантазий!</p>

						<p>Магазин 1001 и 1 кухня предоставляет коллекцию моделей в классическом изысканном стиле, проверенным временем и хорошим вкусом, а также целый ряд кухонь в стиле модерн, но не стоит забывать и о том, что наш магазин готов помочь воплотить непосредственно ваше творческое решение.</p>

						<p>За несколько лет работы мы завоевали доверие и уважение большого числа покупателей из многих городов России. Кухни магазина 1001 и 1 кухня соответствуют европейским стандартам и доступны в ценовом отношении.</p>
					</div>
					<div class="col-md-6 pb-5 order-4 order-md-4">
						<p>Мы готовы вам предложить:</p>
						<ul style="font-size: 1.125rem; list-style: none; padding-left: 0;">
							<li><i class="fas fa-check me-2 text-corporation-orange"></i>кухонные модули различных стилей;</li>
							<li><i class="fas fa-check me-2 text-corporation-orange"></i>разнообразие высококачественных фасадов и фрезеровок, а также цветовой гаммы из материалов ПВХ, итальянского пластика в алюминиевой рамке фирмы ABET, массива дуба и березы, а также эмаль с различными эффектами: высокий глянец, жемчуг, перламутр, ну и, конечно же, непревзойденная эмаль Хамелеон 9 различных цветов;</li>
							<li><i class="fas fa-check me-2 text-corporation-orange"></i>большой выбор столешниц и стеновых панелей, а также столешниц из жидкого камня;</li>
							<li><i class="fas fa-check me-2 text-corporation-orange"></i>разнообразие материалов, цветов, комплектующих и другой фурнитуры кухонных гарнитуров.</li>
						</ul>
						<p>Вся наша мебель изготавливается на высококачественном специализированном оборудовании. В связи с ростом объемов производства магазин 1001 и 1 кухня внедряет новейшее оборудование для изготовления еще более качественной мебели.</p>

						<p>Преимущество нашего магазина в том, что мы изготавливаем любой нестандартный заказ, соответственно, огромный выбор элементов позволяет подобрать мебель в кухню любой конфигурации и площади.</p>

						<p>Обращайтесь к нам, мы предложим вам как недорогие кухни эконом-класса, так и элитные стильные кухни, укомплектованные современными механизмами и аксессуарами.</p>

						<p class="mb-0">Богатый ассортимент, грамотные менеджеры, великолепные кухни – убедительный аргумент заказать кухню для вас именно в нашем магазине 1001 и 1 кухня.</p>
					</div>
					<div class="col-md-6 pb-5 order-3 order-md-3">
						<img src="<?php echo get_template_directory_uri(); ?>/images/about-img-2.jpg" class="rounded shadow" style="max-width: 100%;">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php                                                    //распродажа витринных образцов
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
		<div id="sale-sp" class="scroll-point"></div>
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
</section>


<?php
	//include 'footer.php';
	get_footer();
?> 