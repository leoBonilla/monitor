											<!-- 		<?php var_dump(Yii::$app->user->identity); ?> -->
													<div class="row">
							<div class="col-xl-6">
								<!--begin:: Widgets/Tasks -->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Ultimos registros
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content" role="tab">
														Todos
													</a>
												</li>
											<!-- 	<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content1" role="tab">
														Week
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab3_content1" role="tab">
														Month
													</a>
												</li> -->
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane active" id="m_widget2_tab1_content">
												<div class="m-widget2">
												 <?php foreach ($registros as $key => $value): ?>
												 		<div class="m-widget2__item m-widget2__item--primary">
														<div class="m-widget2__checkbox">
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</div>
														<div class="m-widget2__desc">
															<span class="m-widget2__text">
																<?php echo $value->incidente; ?>
																-
																<?php echo $value->nom_cc; ?>
																-
																<?php echo $value->estado_; ?>
															</span>
															<br>
															<span class="m-widget2__user-name">
																<a href="#" class="m-widget2__link">
																	Por <?php echo $value->username; ?>
																</a> - <?php echo $value->fecha; ?>
															</span>
														</div>	
																												<div class="m-widget2__actions">
															<div class="m-widget2__actions-nav">
																<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
																	<a href="#" class="m-dropdown__toggle">
																		<i class="la la-ellipsis-h"></i>
																	</a>
																	<div class="m-dropdown__wrapper">
																		<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																		<div class="m-dropdown__inner">
																			<div class="m-dropdown__body">
																				<div class="m-dropdown__content">
																					<ul class="m-nav">
																						<li class="m-nav__item">
																							<?php 
																							      $tmp =  explode('/',$value->adjunto);
                                                                                                   $filename = $tmp[1];
                                                                                                   $url = 'index.php?r=monitoreo/default/download-file&file='.$filename;
																							?>
																							<a href="<?php echo $url ; ?>" class="m-nav__link">
																								<i class="m-nav__link-icon flaticon-file"></i>
																								<span class="m-nav__link-text">
																									Adjunto
																								</span>
																							</a>
																						</li>

																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>												
													</div>

												 <?php endforeach ?>




												</div>
											</div>
											<div class="tab-pane" id="m_widget2_tab2_content"></div>
											<div class="tab-pane" id="m_widget2_tab3_content"></div>
										</div>
									</div>
								</div>
								<!--end:: Widgets/Tasks -->
							</div>
							<div class="col-xl-6">
								
							</div>
						</div>