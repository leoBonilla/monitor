					<div class="m-content">
					
					<!--begin::Portlet-->
								<div class="m-portlet m-portlet--tabs">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Detalle de ticket [<?php echo $ticket->ot; ?>]
													<small>
														<?php echo 'Creado el' .$ticket->fecha; ?>
													</small>
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--accent  m-tabs-line--right" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_portlet_tab_4_1" role="tab">
														<i class="fa fa-bar-chart"></i>
														Informacion
													</a>
												</li>
												<li class="nav-item dropdown m-tabs__item">
													<a class="nav-link m-tabs__link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
														<i class="fa fa-cogs"></i>
														Ajustes
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" data-toggle="tab" href="#m_portlet_tab_4_2">
															Enviar Mensaje
														</a>
														<a class="dropdown-item" data-toggle="tab" href="#m_portlet_tab_4_3">
															Comenzar
														</a>
														<a class="dropdown-item" data-toggle="tab" href="#m_portlet_tab_4_1">
															Something else here
														</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" data-toggle="tab" href="#m_portlet_tab_4_2">
															Separated link
														</a>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="tab-content">
											<div class="tab-pane active" id="m_portlet_tab_4_1">
												<h5 class="m-widget_content-title">
													El cliente creo un ticket con el siguiente mensaje
												</h5>
												<p>
													<?php echo $ticket->mensaje; ?>
												</p>

												<p>
												    
												</p>
											</div>
											<div class="tab-pane " id="m_portlet_tab_4_2">
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
											</div>
											<div class="tab-pane " id="m_portlet_tab_4_3">
												Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
											</div>
										</div>
									</div>
								</div>
								<!--end::Portlet-->
						</div>
	<!-- 				</div>
				</div>
			</div>
 -->
