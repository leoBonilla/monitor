                             <div class="col-xl-6 col-lg-12">
								<!--Begin::Portlet-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Notas recientes
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
											<!-- 	<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab1_content" role="tab" aria-selected="false">
														Hoy
													</a>
												</li> -->
												<!-- <li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_widget2_tab2_content" role="tab" aria-selected="true">
														Mensual
													</a>
												</li> -->
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane" id="m_widget2_tab1_content">
												<!--Begin::Timeline 3 -->
												<div class="m-timeline-3">
													<div class="m-timeline-3__items">
													

											
										

														<div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time" >
																17:00
															</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit consectetur eiusmdd tempor
																</span>
																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		By Aziko
																	</a>
																</span>
															</div>
														</div>
													</div>
												</div>
												<!--End::Timeline 3 -->
											</div>
											<div class="tab-pane active show" id="m_widget2_tab2_content">
												<!--Begin::Timeline 3 -->
												<div class="m-timeline-3">
													<?php foreach ($notas as $row): ?>
														<div class="m-timeline-3__items">
						
					
														<div class="m-timeline-3__item m-timeline-3__item--brand" style="width:80%; background-color: red;">
															<span class="m-timeline-3__item-time m--font-danger" style="font-size: 10px;">
																<?php echo $row->fecha_creacion; ?>
															</span>
															<div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	<?php echo $row->nota; ?>
																</span>

																<br>
																<span class="m-timeline-3__item-user-name">
																	<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																		<?php echo $row->titulo; ?>

																	</a>
																</span>
															</div>
														</div>
														<button class="btn m-btn--pill m-btn--air btn-primary btn-sm" style="float:right;">x</button>
													</div>
													<?php endforeach ?>
												</div>
												<!--End::Timeline 3 -->
											</div>
										</div>
									</div>
								</div>
								<!--End::Portlet-->
							</div>