import { jsPDF } from "jspdf"; 
export default  (paciente,antecedentes,gestacion,controles,callback)=>{ 
    
     imgToBase64("assets/img/prenatal.jpg",(base)=>{ 
   
       var doc = new jsPDF('l', 'cm',[15,21.5]);  
       doc.setProperties({
         title: 'Carnet perinatal'
       }); 
       var anchocre=doc.internal.pageSize.getWidth();
       var largocre=doc.internal.pageSize.getHeight();
       doc.addImage(base, 'JPEG',0,0,anchocre,largocre); 
  
    //    doc.setTextColor(255,0,0); 
       doc.setFontSize(7);
       doc.text(paciente.name.toString(), 1.9, 1.48);
       doc.text(paciente.dir.toString(), 2.05, 1.85);
       doc.text(paciente.zona.toString(), 5.6, 1.85);
       doc.text(paciente.nomdepartamento.toString(), 3.25, 2.25);
       doc.text(paciente.nomprovincia.toString(),5.95, 2.25);
       doc.text(paciente.red.toString(),1.55, 2.63);
       doc.text(paciente.telefono.toString(),5.45, 2.63);
       doc.text(paciente.idioma.toString(),2.7, 3.03);
       doc.text(paciente.lengua.toString(),6.1, 3.03);
 
       doc.setFontSize(11);
      
       doc.text( paciente.fechanacimientoo.toString(),8.25, 1.85); //fechanacimiento
       doc.setFontSize(14);
      
       var edad = paciente.edad;
       doc.text(edad.toString(),8.29, 2.86); //edad
       if(edad<15||edad>35){
         doc.setFontSize(11);
         doc.text('X',9.14, 2.78); 
       }
       
       var identificacion = paciente.autoidentificacion;//autoidentificacion
       doc.setFontSize(11);
       switch (identificacion) {
         case 40:
         doc.text('X',10.73, 2.34); 
             break;
         case 42:
         doc.text('X',10.73, 2.86); 
             break;
         default:
         doc.setFontSize(14);
         doc.text(identificacion.toString(),10.96, 1.45);
         doc.setFontSize(11);
             break;
       }
       var alfabeta=paciente.alfabeta; //alfabeta
       if(alfabeta>0){
         doc.text('X',12.1, 2.62); 
       }else{
         doc.text('X',12.1, 1.99); 
       }
    
 
       var estudios=paciente.estudios;//estudios
       switch (estudios) {
         case 0:
         doc.text('X',12.98, 1.7); 
             break; 
         case 1:
         doc.text('X',13.72, 1.7); 
             break; 
         case 2:
         doc.text('X',12.98, 2.3); 
             break; 
         case 3:
         doc.text('X',13.72, 2.3);
             break; 
       } 
         var nivelanios=paciente.nivelanios;//nivelanios
         doc.setFontSize(14);
         doc.text(nivelanios.toString(),13.72, 2.95);
         doc.setFontSize(11);
 
         
         var estadocivil=paciente.estadocivil;//estadocivil  
         switch (estadocivil) {
             case 0:
             doc.text('X',15.3, 1.19);   
                 break;
             case 1:
             doc.text('X',15.3, 1.57);  
                 break;
             case 2:
             doc.text('X',15.3, 1.92);
                 break;
             case 3:
             doc.text('X',15.3, 2.3); 
                 break; 
         }
     var vivesola=paciente.vivesola; //vivesola
       if(vivesola>0){
         doc.text('X',14.62, 3); 
       }else{
         doc.text('X',15.2, 3); 
       }
       doc.text(paciente.controlprenatalen.toString(),17.95, 1.22); 
       doc.text(paciente.partoen.toString(),17.95, 1.82); 
       doc.text(paciente.cip.toString(),16.85, 2.35); //cip
       doc.text(paciente.numhisclinico.toString(),16.85, 2.95); //numhisclinico
 
       
       doc.setFontSize(9);

 if(antecedentes instanceof Object){
       if(antecedentes.tbcf!=null){
        var tbcf=antecedentes.tbcf; //tbcf
        if(tbcf>0){
        doc.text('X',2.04,4.04); 
        }else{
        doc.text('X',1.66,4.04); 
        }
       }
       
       if(antecedentes.tbcp!=null){
        var tbcp=antecedentes.tbcp; //tbcp
            if(tbcp>0){
                doc.text('X',4.38,4.04); 
            }else{
                doc.text('X',3.98,4.04); 
            }
       }
      
 
 if(antecedentes.diabetesf!=null){
var diabetesf=antecedentes.diabetesf; //diabetesf
       if(diabetesf>0){
         doc.text('X',2.04,4.38); 
       }else{
         doc.text('X',1.66,4.38); 
       }
       
 }
       if(antecedentes.diabetesp!=null){
 var diabetesp=antecedentes.diabetesp; //diabetesp
         switch (diabetesp) {
             case 0:
             doc.text('X',3.98,4.38); 
                 break;
             case 1:
             doc.text('X',4.38,4.38); 
                 break;
             case 2:
             doc.text('X',4.74,4.38); 
                 break; 
             case 3:
             doc.text('X',5.13,4.38); 
                 break;
         }
       }
      
       if(antecedentes.hipertensionf!=null){
        var hipertensionf=antecedentes.hipertensionf; //hipertensionf
                if(hipertensionf>0){
                    doc.text('X',2.04,4.75); 
                }else{
                    doc.text('X',1.66,4.75); 
                }
       }
         if(antecedentes.hipertensionp!=null){
        var hipertensionp=antecedentes.hipertensionp; //hipertensionp
                if(hipertensionp>0){
                    doc.text('X',4.38,4.75); 
                }else{
                    doc.text('X',3.98,4.75); 
                }
         }
        
 
         if(antecedentes.preeclampsiaf!=null){
         var preeclampsiaf=antecedentes.preeclampsiaf; //preeclampsiaf
         if(preeclampsiaf>0){
             doc.text('X',2.04,5.09); 
         }else{
             doc.text('X',1.66,5.09); 
         }
         }

         if(antecedentes.preeclampsiap!=null){
         var preeclampsiap=antecedentes.preeclampsiap; //preeclampsiap
         if(preeclampsiap>0){
             doc.text('X',4.38,5.09); 
         }else{
             doc.text('X',3.98,5.09); 
         }
         }

         if(antecedentes.eclampsiaf!=null){
        var eclampsiaf=antecedentes.eclampsiaf; //eclampsiaf
                if(eclampsiaf>0){
                    doc.text('X',2.04,5.41); 
                }else{
                    doc.text('X',1.66,5.41); 
                }
         }
        if(antecedentes.eclampsiap!=null){
         var eclampsiap=antecedentes.eclampsiap; //eclampsiap
         if(eclampsiap>0){
             doc.text('X',4.38,5.41); 
         }else{
             doc.text('X',3.98,5.41); 
         }
        }

         if(antecedentes.otrof!=null){
         var otrof=antecedentes.otrof; //otrof
         if(otrof>0){
             doc.text('X',2.04,5.75); 
         }else{
             doc.text('X',1.66,5.75); 
         }
         }
         if(antecedentes.otrop!=null){
         var otrop=antecedentes.otrop; //otrop
         if(otrop>0){
             doc.text('X',4.38,5.75); 
         }else{
             doc.text('X',3.98,5.75); 
         }
         }

         if(antecedentes.cirtracto!=null){
         var cirtracto=antecedentes.cirtracto; //cirtracto
         if(cirtracto>0){
             doc.text('X',6.79,3.74); 
         }else{
             doc.text('X',6.42,3.74); 
         }
 
         }
         if(antecedentes.infertilidad!=null){
         var infertilidad=antecedentes.infertilidad; //infertilidad
         if(infertilidad>0){
             doc.text('X',6.79,4.04); 
         }else{
             doc.text('X',6.42,4.04); 
         }
         }

         if(antecedentes.cardiopat!=null){
         var cardiopat=antecedentes.cardiopat; //cardiopat
         if(cardiopat>0){
             doc.text('X',6.79,4.4); 
         }else{
             doc.text('X',6.42,4.4); 
         }
         }

        if(antecedentes.nefropatia!=null){
         var nefropatia=antecedentes.nefropatia; //nefropatia
         if(nefropatia>0){
             doc.text('X',6.79,4.75); 
         }else{
             doc.text('X',6.42,4.75); 
         }
        }

        if(antecedentes.violencia!=null){
         var violencia=antecedentes.violencia; //violencia
         if(violencia>0){
             doc.text('X',6.79,5.11); 
         }else{
             doc.text('X',6.42,5.11); 
         }
        }

        if(antecedentes.vih!=null){
         var vih=antecedentes.vih; //vih
         if(vih>0){
             doc.text('X',6.79,5.43); 
         }else{
             doc.text('X',6.42,5.43); 
         }
 
        }
        if(antecedentes.ultimoprevions!=null){
            var ultimoprevions=antecedentes.ultimoprevions; //ultimoprevions
            if(ultimoprevions>0){
                doc.text('X',9.15,4.67); 
            }else{
                doc.text('X',7.99,4.67); 
            }
        }
        if(antecedentes.ultimoprevionormal!=null){
            var ultimoprevionormal=antecedentes.ultimoprevionormal; //ultimoprevionormal
            if(ultimoprevionormal>0){
                doc.text('X',9.15,5.01);
            }else{
                doc.text('X',7.99,5.01); 
            }
        }
      

        if(antecedentes.antecedentesgemelares!=null){
            var antecedentesgemelares=antecedentes.antecedentesgemelares; //antecedentesgemelares
            if(antecedentesgemelares>0){
                doc.text('X',8.64,5.72); 
            }else{
                doc.text('X',9.11,5.72);
            }
        }
       
        if(antecedentes.tresconsecutivos!=null){
            var tresconsecutivos=antecedentes.tresconsecutivos; //tresconsecutivos
            if(tresconsecutivos>0){
                doc.text('X',11.57,4.47);           
            }
        }
        
        if(antecedentes.gestasprevias!=null){
            var gestasprevias=antecedentes.gestasprevias; //gestasprevias
            doc.setFontSize(14); 
            doc.text(gestasprevias.toString(),9.6,3.95); 
            doc.setFontSize(9);
        }
       
       

        if(antecedentes.ectopico!=null){
            var ectopico=antecedentes.ectopico; //ectopico
            doc.setFontSize(14); 
            doc.text(ectopico.toString(),9.99,4.58); 
            doc.setFontSize(9);
        }
        if(antecedentes.partos!=null){
            var partos=antecedentes.partos; //partos
            doc.setFontSize(14); 
            doc.text(partos.toString(),10.94,5.75); 
            doc.setFontSize(9);
        }
        if(antecedentes.abortos!=null){
            var abortos=antecedentes.abortos; //abortos
            doc.setFontSize(14); 
            doc.text(abortos.toString(),11.1,3.95); 
            doc.setFontSize(9);
        }
        if(antecedentes.vaginales!=null){
            var vaginales=antecedentes.vaginales; //vaginales
            doc.setFontSize(14); 
            doc.text(vaginales.toString(),12.13,3.95); 
            doc.setFontSize(9);
        }
        if(antecedentes.cesareas!=null){
            var cesareas=antecedentes.cesareas; //cesareas
            doc.setFontSize(14); 
            doc.text(cesareas.toString(),12.3,5.75); 
            doc.setFontSize(9);
        }
        if(antecedentes.nacidosvivos!=null){
            var nacidosvivos=antecedentes.nacidosvivos; //nacidosvivos
            doc.setFontSize(14); 
            doc.text(nacidosvivos.toString(),13.43,3.95); 
            doc.setFontSize(9);
        }
        if(antecedentes.nacidosmuertos!=null){
            var nacidosmuertos=antecedentes.nacidosmuertos; //nacidosmuertos
            doc.setFontSize(14); 
            doc.text(nacidosmuertos.toString(),13.58,5.75); 
            doc.setFontSize(9);
        }
        if(antecedentes.viven!=null){
            var viven=antecedentes.viven; //viven
            doc.setFontSize(14); 
            doc.text(viven.toString(),14.94,3.95); 
            doc.setFontSize(9);
        }
        if(antecedentes.muertossemana!=null){
            var muertossemana=antecedentes.muertossemana; //muertossemana
            doc.setFontSize(14); 
            doc.text(muertossemana.toString(),15.3,5.05); 
            doc.setFontSize(9);
        }
        if(antecedentes.muertosdespuessemana!=null){
            var muertosdespuessemana=antecedentes.muertosdespuessemana; //muertosdespuessemana
            doc.setFontSize(14); 
            doc.text(muertosdespuessemana.toString(),15.3,5.75); 
            doc.setFontSize(9);
        }
         
        if(antecedentes.embarazoplaneado!=null){
            var embarazoplaneado=antecedentes.embarazoplaneado; //embarazoplaneado
            if(embarazoplaneado>0){
                doc.text('X',19.82,4.81);
            }else{
                doc.text('X',19.15,4.81);
            }
        }
        if(antecedentes.finembarazoanteriorr!=null){
            var finembarazoanteriorr=antecedentes.finembarazoanteriorr; //finembarazoanteriorr
            doc.setFontSize(14); 
            doc.text(finembarazoanteriorr.toString(),16.55,4.21); 
            doc.setFontSize(9);
        } 

        if(antecedentes.fracasometodo!=null){
            var fracasometodo=antecedentes.fracasometodo; //fracasometodo
            switch (fracasometodo) {
                case 0:
                    doc.text('X',16.18,5.49);
                    break;
                case 1:
                    doc.text('X',17.05,5.49);
                    break;
                case 2:
                    doc.text('X',17.8,5.49);
                    break;
                case 3:
                    doc.text('X',18.58,5.49);
                    break;
                case 4:
                    doc.text('X',19.35,5.49);
                    break;
                case 5:
                    doc.text('X',20.13,5.49);
                    break; 
            }
        }
    }
    if(gestacion instanceof Object){
      
        if(gestacion.evaluacionnutricional!=null){
            var evaluacionnutricional=gestacion.evaluacionnutricional; //evaluacionnutricional
            switch (evaluacionnutricional) {
                case 0:
                    doc.text('X',4.15,6.97);
                    break;
                case 1:
                    doc.text('X',4.72,6.97);
                    break;
                case 2:
                    doc.text('X',4.15,7.3);
                    break;
                case 3:
                    doc.text('X',4.72,7.3);
                    break; 
            }
        } 
        if(gestacion.pesoanterior!=null){
            var pesoanterior=gestacion.pesoanterior; //pesoanterior
            doc.setFontSize(12); 
            doc.text(pesoanterior.toString(),1.2,7.05); 
            doc.setFontSize(9);
        } 
        if(gestacion.talla!=null){
            var talla=gestacion.talla; //talla
            doc.setFontSize(12); 
            doc.text(talla.toString(),2.69,7.05); 
            doc.setFontSize(9);
        } 
        if(gestacion.imc!=null){
            var imc=gestacion.imc; //imc
            doc.setFontSize(12); 
            doc.text(imc.toString(),4.1,6.6);
            doc.setFontSize(9);
        } 

        if(gestacion.fppdatee!=null){
            var fppdatee=gestacion.fppdatee; //fppdate
            doc.setFontSize(14); 
            doc.text(fppdatee.toString(),5.76,6.6); 
            doc.setFontSize(9);
        } 
        if(gestacion.fumdatee!=null){
            var fumdatee=gestacion.fumdatee; //fumdate
            doc.setFontSize(14); 
            doc.text(fumdatee.toString(),5.76,7.2); 
            doc.setFontSize(9);
        } 

        if(gestacion.fum!=null){
            var fum=gestacion.fum; //fum
            if(fum>0){
                doc.text('X',9.46,6.85); 
            }else{
                doc.text('X',9.04,6.85); 
            }
        }
        if(gestacion.eco!=null){
            var eco=gestacion.eco; //eco
            if(eco>0){
                doc.text('X',9.46,7.25); 
            }else{
                doc.text('X',9.04,7.25); 
            }
        }
        
        

        if(gestacion.fumaact1!=null){
            var fumaact1=gestacion.fumaact1; //fumaact1
            if(fumaact1>0){
                doc.text('X',11.06,6.82);
            }else{
                doc.text('X',10.7,6.82); 
            }
        }
        if(gestacion.fumaact2!=null){
            var fumaact2=gestacion.fumaact2; //fumaact2
            if(fumaact2>0){
                doc.text('X',11.06,7.25);
            }else{
                doc.text('X',10.7,7.25); 
            }
        }
        if(gestacion.fumapas1!=null){
            var fumapas1=gestacion.fumapas1; //fumapas1
            if(fumapas1>0){
                doc.text('X',12.06,6.82);
            }else{
                doc.text('X',11.7,7.25); 
            }
        }
        if(gestacion.fumapas2!=null){
            var fumapas2=gestacion.fumapas2; //fumapas2
            if(fumapas2>0){
                doc.text('X',12.06,7.25);
            }else{
                doc.text('X',11.7,6.82); 
            }
        }
        if(gestacion.drogas1!=null){
            var drogas1=gestacion.drogas1; //drogas1
            if(drogas1>0){
                doc.text('X',12.98,6.82);
            }else{
                doc.text('X',12.62,6.82);
            }
        }
        if(gestacion.drogas2!=null){
            var drogas2=gestacion.drogas2; //drogas2
            if(drogas2>0){
                doc.text('X',12.98,7.25);
            }else{
                doc.text('X',12.62,7.25); 
            }
        }
        if(gestacion.alcohol1!=null){
            var alcohol1=gestacion.alcohol1; //alcohol1
            if(alcohol1>0){
                doc.text('X',13.88,6.82);
            }else{
                doc.text('X',13.52,6.82); 
            }
        }
        if(gestacion.alcohol2!=null){
            var alcohol2=gestacion.alcohol2; //alcohol2
            if(alcohol2>0){
                doc.text('X',13.88,7.25); 
            }else{
                doc.text('X',13.52,7.25);
            }
        }
        if(gestacion.violencia1!=null){
            var violencia1=gestacion.violencia1; //violencia1
            if(violencia1>0){
                doc.text('X',14.78,6.82);
            }else{
                doc.text('X',14.42,6.82); 
            }
        }
        if(gestacion.violencia2!=null){
            var violencia2=gestacion.violencia2; //violencia2
            if(violencia2>0){
                doc.text('X',14.78,7.25);
            }else{
                doc.text('X',14.42,7.25); 
            }
        }


        if(gestacion.natirubeola!=null){
            var natirubeola=gestacion.natirubeola; //natirubeola
           switch (natirubeola) {
            case 0:
                doc.text('X',15.58,6.65);   
                break; 
            case 1:
                doc.text('X',16.2,6.65); 
                break; 
            case 2:
                doc.text('X',15.58,7.17); 
                break; 
            case 3:
                doc.text('X',16.2,7.17); 
                break; 
           }
        }
        if(gestacion.antitetanicavigente!=null){
            var antitetanicavigente=gestacion.antitetanicavigente; //antitetanicavigente
            if(antitetanicavigente>0){
                doc.text('X',18.65,6.47);
            }else{
                doc.text('X',18.07,6.47);
            }
        }
        if(gestacion.dosis1!=null){
            var dosis1=gestacion.dosis1; //dosis1
            if(dosis1>0){
                doc.text('X',17.68,7.05);
            }
        }
        if(gestacion.dosis2!=null){
            var dosis2=gestacion.dosis2; //dosis2
            if(dosis2>0){
                doc.text('X',18.58,7.05);
            }
        }
        if(gestacion.odont!=null){
            var odont=gestacion.odont; //odont
            if(odont>0){
                doc.text('X',20.19,6.72);
            }else{
                doc.text('X',19.78,6.72);
            }
        }
        if(gestacion.mamas!=null){
            var mamas=gestacion.mamas; //mamas
            if(mamas>0){
                doc.text('X',20.19,7.12);
            }else{
                doc.text('X',19.78,7.12);
            }
        }
        
        if(gestacion.pap!=null){
            var pap=gestacion.pap; //pap
           switch (pap) {
            case 0:
                doc.text('X',1.68,8.3);  
                break; 
            case 1:
                doc.text('X',2.1,8.3);
                break; 
            case 2:
                doc.text('X',2.5,8.3);
                break; 
           }
        }
        
        if(gestacion.colp!=null){
            var colp=gestacion.colp; //colp
           switch (colp) {
            case 0:
                doc.text('X',1.68,8.7);
                break; 
            case 1:
                doc.text('X',2.1,8.7);
                break; 
            case 2:
                doc.text('X',2.5,8.7);
                break; 
           }
        }
        
         
        
        if(gestacion.grupo!=null){
            var grupo=gestacion.grupo; //grupo
            doc.text(grupo.toString().toUpperCase(),3.1,8.05);
        }
       
        if(gestacion.rh!=null){
            var rh=gestacion.rh; //rh
            if(rh>0){
                doc.text('X',4.05,8.09);
            }else{
                doc.text('X',3.65,8.09);
            }
        }
        if(gestacion.inmuniz!=null){
            var inmuniz=gestacion.inmuniz; //inmuniz
            if(inmuniz>0){
                doc.text('X',4.95,8.09);
            }else{
                doc.text('X',4.58,8.09);
            }
        }
       
        
        if(gestacion.antid!=null){
            var antid=gestacion.antid; //antid
           switch (antid) {
            case 0:
                doc.text('X',3.15,8.79);
                break; 
            case 1:
                doc.text('X',3.78,8.79);
                break; 
            case 2:
                doc.text('X',4.3,8.79);
                break; 
           }
        }
        
        
        if(gestacion.glicemia20!=null){
            var glicemia20=gestacion.glicemia20; //glicemia20 
            doc.text(glicemia20.toString(),6.24,7.78); 
        } 

        if(gestacion.glicemia30!=null){
            var glicemia30=gestacion.glicemia30; //glicemia30 
            doc.text(glicemia30.toString(),6.24,8.74); 
        } 
          

        if(gestacion.glicemia20105!=null){
            var glicemia20105=gestacion.glicemia20105; //glicemia20105
            if(glicemia20105>0){
                doc.text('X',7.4,7.81);
            }
        }
        if(gestacion.glicemia30105!=null){
            var glicemia30105=gestacion.glicemia30105; //glicemia30105
            if(glicemia30105>0){
                  doc.text('X',7.4,8.71);
            }
        }
        if(gestacion.anemiamenor!=null){
            var anemiamenor=gestacion.anemiamenor; //anemiamenor
            if(anemiamenor>0){
                doc.text('X',8.63,8.71);
            }
        }
        if(gestacion.hbmenor!=null){
            var hbmenor=gestacion.hbmenor; //hbmenor
            if(hbmenor>0){
                doc.text(hbmenor.toString(),7.93,8.18);
            }
        }
        
        if(gestacion.hierro!=null){
            var hierro=gestacion.hierro; //hierro
            if(hierro>0){
                doc.text('X',10.69,8.35);
            }else{
                doc.text('X',10.3,8.35);
            }
        }
        if(gestacion.folatos!=null){
            var folatos=gestacion.folatos; //folatos
            if(folatos>0){
                doc.text('X',10.69,8.75);
            }else{
                doc.text('X',10.3,8.75);
            }
        }
       
         
        if(gestacion.anemiamayor!=null){
            var anemiamayor=gestacion.anemiamayor; //anemiamayor
            if(anemiamayor>0){
                doc.text('X',12.01,8.71);
            }
        }
        
        if(gestacion.hbmayor!=null){
            var hbmayor=gestacion.hbmayor; //hbmayor
            if(hbmayor>0){
                doc.text(hbmayor.toString(),11.33,8.18);
            }
        }
        if(gestacion.vihsolmenor!=null){
            var vihsolmenor=gestacion.vihsolmenor; //vihsolmenor
            if(vihsolmenor>0){
                doc.text('X',13.56,8.65);
            }else{
                doc.text('X',13.13,8.65);
            }
        }
       
        if(gestacion.vihpruebamenor!=null){
            var vihpruebamenor=gestacion.vihpruebamenor; //vihpruebamenor
           switch (vihpruebamenor) {
            case 0:
                doc.text('X',14.28,8.22);
                break; 
            case 1:
                doc.text('X',14.28,8.55);
                break; 
            case 2:
                doc.text('X',14.28,8.88);
                break; 
            case 3:
                doc.text('X',14.68,8.88); 
                break; 
           }
        }
       
        if(gestacion.vihtratmenor!=null){
            var vihtratmenor=gestacion.vihtratmenor; //vihtratmenor
           switch (vihtratmenor) {
            case 0:
                doc.text('X',15.12,8.5);
                break; 
            case 1:
                doc.text('X',15.52,8.5);
                break; 
            case 2:
                doc.text('X',15.52,8.88);
                break; 
           }
        }
        if(gestacion.vihtratmayor!=null){
            var vihtratmayor=gestacion.vihtratmayor; //vihtratmayor
           switch (vihtratmayor) {
            case 0:
                doc.text('X',15.12,9.8);
                break; 
            case 1:
                doc.text('X',15.52,9.8);
                break; 
            case 2:
                doc.text('X',15.52,10.18);
                break; 
           }
        }
       

         
        
        if(gestacion.vihsolmayor!=null){
            var vihsolmayor=gestacion.vihsolmayor; //vihsolmayor
            if(vihsolmayor>0){
                doc.text('X',13.56,9.95);
            }else{
                doc.text('X',13.13,9.95);
            }
        }
       
        if(gestacion.vihpruebamayor!=null){
            var vihpruebamayor=gestacion.vihpruebamayor; //vihpruebamayor
           switch (vihpruebamayor) {
            case 0:
                doc.text('X',14.28,9.52);
                break; 
            case 1:
                doc.text('X',14.28,9.85);
                break; 
            case 2:
                doc.text('X',14.28,10.15);
                break; 
            case 3:
                doc.text('X',14.68,10.15); 
                break; 
           }
        }
        if(gestacion.sifilismenorrpr!=null){
            var sifilismenorrpr=gestacion.sifilismenorrpr; //sifilismenorrpr
           switch (sifilismenorrpr) {
            case 0:
                doc.text('X',16.35,8.56);
                break; 
            case 1:
                doc.text('X',16.7,8.56);
                break; 
            case 2:
                doc.text('X',17.08,8.56);
                break;  
           }
        }
       
        if(gestacion.sifilismenortrat!=null){
            var sifilismenortrat=gestacion.sifilismenortrat; //sifilismenortrat
           switch (sifilismenortrat) {
            case 0:
                doc.text('X',17.8,8.36);
                break; 
            case 1:
                doc.text('X',18.15,8.36);
                break; 
            case 2:
                doc.text('X',18.65,8.36);
                break; 
            case 3:
                doc.text('X',18.99,8.36);
                break; 
           }
        }
        
       
        if(gestacion.sifilismenortratpareja!=null){
            var sifilismenortratpareja=gestacion.sifilismenortratpareja; //sifilismenortratpareja
           switch (sifilismenortratpareja) {
            case 0:
                doc.text('X',19.6,8.48);
                break; 
            case 1:
                doc.text('X',20.1,8.48);
                break; 
            case 2:
                doc.text('X',19.6,9);
                break; 
            case 3:
                doc.text('X',20.1,9);
                break; 
           }
        }
       

         
       
        if(gestacion.sifilismenor20!=null){
            var sifilismenor20=gestacion.sifilismenor20; //sifilismenor20
            if(sifilismenor20>0){
                doc.text(sifilismenor20.toString(),16.65,8.95);
            }
        }
        if(gestacion.sifilismenor!=null){
            var sifilismenor=gestacion.sifilismenor; //sifilismenor
            if(sifilismenor>0){
                doc.text(sifilismenor.toString(),18.05,8.9);
            }
        }
       

  
        



        if(gestacion.sifilismayorrpr!=null){
            var sifilismayorrpr=gestacion.sifilismayorrpr; //sifilismayorrpr
           switch (sifilismayorrpr) {
            case 0:
                doc.text('X',16.35,10.22);
                break; 
            case 1:
                doc.text('X',16.7,10.22);
                break; 
            case 2:
                doc.text('X',17.08,10.22);
                break;  
           }
        }

        if(gestacion.sifilismayortrat!=null){
            var sifilismayortrat=gestacion.sifilismayortrat; //sifilismayortrat
           switch (sifilismayortrat) {
            case 0:
                doc.text('X',17.83,10.22);
                break; 
            case 1:
                doc.text('X',18.18,10.22);
                break; 
            case 2:
                doc.text('X',18.55,10.22);
                break; 
            case 3:
                doc.text('X',18.89,10.22);
                break; 
           }
        }
        
       
        if(gestacion.sifilismayortratpareja!=null){
            var sifilismayortratpareja=gestacion.sifilismayortratpareja; //sifilismayortratpareja
           switch (sifilismayortratpareja) {
            case 0:
                doc.text('X',19.6,9.68);
                break; 
            case 1:
                doc.text('X',20.1,9.68);
                break; 
            case 2:
                doc.text('X',19.6,10.2);
                break; 
            case 3:
                doc.text('X',20.1,10.2);
                break; 
           }
        }
       

        if(gestacion.sifilismayor20!=null){
            var sifilismayor20=gestacion.sifilismayor20; //sifilismayor20
            if(sifilismayor20>0){
                doc.text(sifilismayor20.toString(),16.65,9.55);
            }
        }
        if(gestacion.sifilismayor!=null){
            var sifilismayor=gestacion.sifilismayor; //sifilismayor
            if(sifilismayor>0){
                doc.text(sifilismayor.toString(),18.05,9.55);
            }
        }
        
        if(gestacion.planeadoparto!=null){
            var planeadoparto=gestacion.planeadoparto; //planeadoparto
            if(planeadoparto>0){
                doc.text('X',1.78,10.05);
            }else{
                doc.text('X',1.31,10.05);
            }
        }
        if(gestacion.orientacion!=null){
            var orientacion=gestacion.orientacion; //orientacion
            if(orientacion>0){
                doc.text('X',3,10.05);
            }else{
                doc.text('X',2.5,10.05);
            }
        }
        if(gestacion.orina!=null){
            var orina=gestacion.orina; //orina
            if(orina>0){
                doc.text('X',4.12,10.05);
            }else{
                doc.text('X',3.75,10.05);
            }
        }
       
       
        if(gestacion.bacteriuriamenor!=null){
            var bacteriuriamenor=gestacion.bacteriuriamenor; //bacteriuriamenor
           switch (bacteriuriamenor) {
            case 0:
                doc.text('X',5.1,9.85);
                break; 
            case 1:
                doc.text('X',5.6,9.85);
                break; 
            case 2:
                doc.text('X',6.15,9.85);
                break; 
           }
        }
     
       
        if(gestacion.bacteriuriamayor!=null){
            var bacteriuriamayor=gestacion.bacteriuriamayor; //bacteriuriamayor
           switch (bacteriuriamayor) {
            case 0:
                doc.text('X',5.1,10.2);
                break; 
            case 1:
                doc.text('X',5.6,10.2);
                break; 
            case 2:
                doc.text('X',6.15,10.2);
                break; 
           }
        }
        if(gestacion.chagas!=null){
            var chagas=gestacion.chagas; //chagas
           switch (chagas) {
            case 0:
                doc.text('X',7.08,9.5);
                break; 
            case 1:
                doc.text('X',7.08,9.85);
                break; 
            case 2:
                doc.text('X',7.08,10.18);
                break; 
           }
        }
        if(gestacion.paludismo!=null){
            var paludismo=gestacion.paludismo; //paludismo
           switch (paludismo) {
            case 0:
                doc.text('X',7.68,9.72);
                break; 
            case 1:
                doc.text('X',8.08,9.72);
                break; 
            case 2:
                doc.text('X',8.45,9.72);
                break; 
           }
        }
      
        if(gestacion.estreptococo!=null){
            var estreptococo=gestacion.estreptococo; //estreptococo
           switch (estreptococo) {
            case 0:
                doc.text('X',9.08,9.82);
                break; 
            case 1:
                doc.text('X',9.48,9.82);
                break; 
            case 2:
                doc.text('X',9.88,9.82);
                break; 
           }
        }
        if(gestacion.toxoplasmosismenor!=null){
            var toxoplasmosismenor=gestacion.toxoplasmosismenor; //toxoplasmosismenor
           switch (toxoplasmosismenor) {
            case 0:
                doc.text('X',11.68,9.56);
                break; 
            case 1:
                doc.text('X',12.15,9.56);
                break; 
            case 2:
                doc.text('X',12.58,9.56);
                break; 
           }
        }
      
        if(gestacion.toxoplasmosismayor!=null){
            var toxoplasmosismayor=gestacion.toxoplasmosismayor; //toxoplasmosismayor
           switch (toxoplasmosismayor) {
            case 0:
                doc.text('X',11.68,9.86);
                break; 
            case 1:
                doc.text('X',12.15,9.86);
                break; 
            case 2:
                doc.text('X',12.58,9.86);
                break; 
           }
        }
      
      
        if(gestacion.toxoplasmosisconsulta!=null){
            var toxoplasmosisconsulta=gestacion.toxoplasmosisconsulta; //toxoplasmosisconsulta
           switch (toxoplasmosisconsulta) {
            case 0:
                doc.text('X',11.68,10.22);
                break; 
            case 1:
                doc.text('X',12.15,10.22);
                break; 
            case 2:
                doc.text('X',12.58,10.22);
                break; 
           }
        }
       
    }
    if(Array.isArray(controles)){
        var posy=11.02;
        controles.forEach(element => {
             doc.setFontSize(11);
             doc.text(element.asisfechaa.toString(),1.5,posy); 
             doc.setFontSize(9);
             if(element.peso!=null){
             doc.text(element.peso.toString(),3.8,posy);
            }
            if(element.imc!=null){
                doc.text(element.imc.toString(),4.8,posy);
            }
            if(element.pa!=null){
                doc.text(element.pa.toString(),5.4,posy);
            }
            if(element.edadgest!=null){
                doc.text(element.edadgest.toString(),6.45,posy);
            }
            if(element.alturauterina!=null){
                doc.text(element.alturauterina.toString(),7.25,posy);
            }
            if(element.presentacion!=null){
                
                switch (element.presentacion) {
                    case 0:
                        doc.text('CEF',8,posy);
                        break; 
                    case 1:
                        doc.text('PEL',8,posy);
                        break; 
                    case 2:
                        doc.text('TRA',8,posy);
                        break; 
                }
            }
            if(element.fcf!=null){
                doc.setFontSize(8);
                doc.text(element.fcf.toString(),8.81,posy);
                doc.setFontSize(9);
            }
            if(element.movimfetales!=null){ 
                doc.text(element.movimfetales.toString(),9.81,posy); 
            }
            if(element.proteinuria!=null){ 
                doc.text(element.proteinuria.toString(),10.55,posy); 
            }
            if(element.numtabferroso!=null){ 
                doc.text(element.numtabferroso.toString(),11.25,posy); 
            }
            if(element.tratamientos!=null){ 
                doc.setFontSize(7);
                doc.text(element.tratamientos.toString(),12,posy); 
                doc.setFontSize(9);
            }
            if(element.name!=null){ 
                doc.setFontSize(5);
                doc.text("Dr. "+element.name.toString().split(" ")[0],17.7,posy-0.05);  
            }
            if(element.proximacitaa!=null){ 
                doc.setFontSize(9);
                doc.text(element.proximacitaa.toString(),19,posy);  
            }
            posy+=0.52; 
        });
    }

   
 
             callback(doc.output('datauristring')); 

       })
 }
  function imgToBase64(src, callback) {
    var outputFormat = src.substr(-3) === 'png' ? 'image/png' : 'image/jpeg';
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function () {
      var canvas = document.createElement('CANVAS');
      var ctx = canvas.getContext('2d');
      var dataURL;
      canvas.height = this.naturalHeight;
      canvas.width = this.naturalWidth;
      ctx.drawImage(this, 0, 0);
      dataURL = canvas.toDataURL(outputFormat);
      callback(dataURL);
    };
    img.src = src;
    if (img.complete || img.complete === undefined) {
      img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
      img.src = src;
    }
  }