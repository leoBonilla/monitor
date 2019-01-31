    <!-- <style> -->
    <table class="body" data-made-with-foundation="">
      <tr>
        <td class="float-center" align="center" valign="top">
          <center data-parsed="">
            <table class="spacer float-center">
              <tbody>
                <tr>
                  <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                </tr>
              </tbody>
            </table>
            <table align="center" class="container float-center">
              <tbody>
                <tr>
                  <td>
            <!--         <table class="spacer">
                      <tbody>
                        <tr>
                          <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                        </tr>
                      </tbody>
                    </table> -->
                    <table class="row">
                      <tbody>
                        <tr>
                          <td>
                            <img src="assets/email/logo.png" alt="">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="row">
                      <tbody>
                        <tr>
                          <th class="small-12 large-12 columns first last">
                            <table>
                              <tr>
                                <th>
                                  <h3>Nuevo ticket de soporte asignado.</h3>
                                  <p> </p>
                                  <table class="spacer">
                                    <tbody>
                                      <tr>
                                        <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                                      </tr>
                                    </tbody>
                                  </table>

                                  <h4>Detalle del ticket</h4>
                                  <table>
                                    <tr>
                                      <th style="text-align: left;width:100px;">Nº de Ticket</th>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['ot']; ?></td>
                                    </tr>
                                    <tr>
                                      <td style="text-align: left;width:100px;">Asunto</td>
                                     <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['asunto']; ?></td>
                                    </tr>
                                    <tr>
                                      <td style="text-align: left;width:100px;">Contacto</td>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['contacto']; ?></td>
                                    </tr>
                                    <tr>
                                      <td style="text-align: left;width:100px;">Email</td>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['con_email']; ?></td>
                                    </tr>
                                     <tr>
                                      <td style="text-align: left;width:100px;">Equipo</td>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['equipo']; ?></td>
                                    </tr>

                                     <tr>
                                      <td style="text-align: left;width:100px;">Numero de serie</td>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['serie']; ?></td>
                                    </tr>

                                     <tr>
                                      <td style="text-align: left;width:100px;">Ubicacion</td>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['ubicacion']; ?></td>
                                    </tr>

                                     <tr>
                                      <td style="text-align: left;width:100px;">Fecha de apertura</td>
                                      <td style="text-align: center;width:10px;">:</td>
                                      <td style="text-align: left;"><?php echo $data['fecha']; ?></td>
                                    </tr>


                                  </table>
                                  <hr>

                                  <p>Puede gestionar el ticket el siguiente <a href="<?php echo $data['url'] ?>">Link</a></p>
                                </th>
                              </tr>
                            </table>
                          </th>
                        </tr>
                      </tbody>
                    </table>
    
                  </td>
                </tr>
              </tbody>
            </table>
          </center>
        </td>
      </tr>
    </table>