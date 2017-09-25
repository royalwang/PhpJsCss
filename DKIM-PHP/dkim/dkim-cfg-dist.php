<?php
/***************************************************************************\
*  DKIM-CFG ($Id: dkim-cfg-dist.php,v 1.2 2008/09/30 10:21:52 evyncke Exp $)
*  
*  Copyright (c) 2008 
*  Eric Vyncke
*          
* This program is a free software distributed under GNU/GPL licence.
* See also the file GPL.html
*
* THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR 
* IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
* OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
* IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
* NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
* DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
* THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
* (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
*THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 ***************************************************************************/
 
// Uncomment the $open_SSL_pub and $open_SSL_priv variables and
// copy and paste the content of the public- and private-key files INCLUDING
// the first and last lines (those starting with ----)

//$open_SSL_pub="-----BEGIN PUBLIC KEY-----
//... copy & paste your public key
//-----END PUBLIC KEY-----" ;

//$open_SSL_priv="" ;

// DKIM Configuration

$open_SSL_priv="-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCufUsKVfjaI2Iv
Sq495hUOc949YnfzitQXZjfI+ZwiJBUJC2kd2snUHL1e3N6avSIc28geAe5t6M5p
dlluZQEwr9ppeJNmdrTB9y7Zn3PwrJFebbmpUGVTttRgUKbsuCy0HCzdL6+onf8S
Uu1ezcnPgpN7F0sE+KNCrakG2nJTDQlGqqdNOATWnF1Ukq5kNXXxucIJ36Y0yy95
3t8RwowIDRwb+JM6qef32rJ7Z9Nshiw+cyBbr3d/R67gQwOuwCBRF4JDdrslUbJG
bG09u3736okXChojcGuQiuTcEVqV3MyXEAxGJ740sZDBC3ZcmcoBzpUeFnAViGkC
NxNpp90nAgMBAAECgf8IlsutHJX3DeHHZLG5mc+tIDFVLL9Yp4R+FdzH6QKDIw2o
bfD8R7WI1liqM/OkU67i2aWWRDE6yCet8EgWch4Iq5W4WAEymlwhHOFX/2CgeDqJ
JDBUHZVxkxrdTiiBZ2rm3J7V2KekfMQwUOp3VGpkznhJqheIOlxwpoOreiaZ/0gt
K+BqYJNFX/Ez1aU0pbE4nC5DjRM+j9jAQIwPLOD9ra7cj0Ao6hPuXBAFDd8X98Vv
q3fo0YA3MxlbSarR9iXdxAydklry4//1LrxE26MSgOB6R6gcPRczGfNhQbFlbVUJ
9XnEg4Fme862e3/xnrGXqEQH7o911mm+d9a2jKECgYEA5FGn2kyDs5m3wHqpaZRm
QDxFuQY2JBoHvme/O+CAr6W6J4AWa/+/7wqb4azv4EslgZwCWFuhlaWnAbjLfvVK
yBNv7rxtRTc3LfpMQR3C2eejXQWVeFkQaFuOw9xFa2dlfbVUcQK7r/Sl4syNMMEt
B8AL1hmbXtglJtWMxH11s00CgYEAw6Ttj2/wOiPw7kxsNS3CxdMNoM508yqwoxPI
KzlXIH3MmGDiAzs6YB0t1jxdI3MnE+pIaK53pb303IJIJCLBmg8jywRZolgnUmAY
gYA2bkVUbMINF2tbKrlVLiI6uK21MFYrCyEeQmcQeFJ/wdXwTa0wPlLyuCpOTvOp
UJZpsEMCgYEAr9pIqzWVlsZFpiWTyHL5Um5Z0Ul8d8/ouPmVbBvdYewGdhgMrQAd
p5KHP4mAdEPMzogHsmBZEza0a/oWGmH5SCLYaouMqev+PxZylxDCHC1yQNplJn2K
yqYCTs6gVTodDHaWZDiTsNGA1y9va+bNtRNwymWMqr9V1hRSyKBNAF0CgYA7Y3dR
kVNE8uASFlTKl8eGMZjzdXh+0DiqaDjdFhzimg1fPBmfjX0c6/6cB9rmBfCY1QeB
72QWheEshsfLYFmQoIPm/r0O0N+u28jUlszvEFCeaxF6SHZ2M6gtxuo4YVKdB6st
R7JdyddwDusFNiIqEiaQ5LEVQpJe2QxOkDoo7QKBgQCTOzaxe1c0lywL0v45CzQ8
IvZ/m7pChravvdWfarozAt5szXu1mdJkQ7BdhgdoR+FDMgqKqR/EvM723ahN+ZgA
mkIuOze+UBAxCU8Ktd6Jia0AO5zcvDF4P6Be36p6fJyN7D5ZtmzlH1Kj0h1yEigG
1GcVd8Mk1OTdBT7nya6mlw==
-----END PRIVATE KEY-----";

$open_SSL_pub="-----BEGIN CERTIFICATE-----
MIIFBDCCA+ygAwIBAgISA84gyfNRLaGZd3HNZJ0FuQ2DMA0GCSqGSIb3DQEBCwUA
MEoxCzAJBgNVBAYTAlVTMRYwFAYDVQQKEw1MZXQncyBFbmNyeXB0MSMwIQYDVQQD
ExpMZXQncyBFbmNyeXB0IEF1dGhvcml0eSBYMzAeFw0xNzA3MTcwNjM1MDBaFw0x
NzEwMTUwNjM1MDBaMBQxEjAQBgNVBAMTCXFmbGFzaC5wbDCCASIwDQYJKoZIhvcN
AQEBBQADggEPADCCAQoCggEBAK59SwpV+NojYi9Krj3mFQ5z3j1id/OK1BdmN8j5
nCIkFQkLaR3aydQcvV7c3pq9IhzbyB4B7m3ozml2WW5lATCv2ml4k2Z2tMH3Ltmf
c/CskV5tualQZVO21GBQpuy4LLQcLN0vr6id/xJS7V7Nyc+Ck3sXSwT4o0KtqQba
clMNCUaqp004BNacXVSSrmQ1dfG5wgnfpjTLL3ne3xHCjAgNHBv4kzqp5/fasntn
02yGLD5zIFuvd39HruBDA67AIFEXgkN2uyVRskZsbT27fvfqiRcKGiNwa5CK5NwR
WpXczJcQDEYnvjSxkMELdlyZygHOlR4WcBWIaQI3E2mn3ScCAwEAAaOCAhgwggIU
MA4GA1UdDwEB/wQEAwIFoDAdBgNVHSUEFjAUBggrBgEFBQcDAQYIKwYBBQUHAwIw
DAYDVR0TAQH/BAIwADAdBgNVHQ4EFgQUlOqC2gspQG/vBsWCS/TwZblKn3cwHwYD
VR0jBBgwFoAUqEpqYwR93brm0Tm3pkVl7/Oo7KEwbwYIKwYBBQUHAQEEYzBhMC4G
CCsGAQUFBzABhiJodHRwOi8vb2NzcC5pbnQteDMubGV0c2VuY3J5cHQub3JnMC8G
CCsGAQUFBzAChiNodHRwOi8vY2VydC5pbnQteDMubGV0c2VuY3J5cHQub3JnLzAj
BgNVHREEHDAagglxZmxhc2gucGyCDXd3dy5xZmxhc2gucGwwgf4GA1UdIASB9jCB
8zAIBgZngQwBAgEwgeYGCysGAQQBgt8TAQEBMIHWMCYGCCsGAQUFBwIBFhpodHRw
Oi8vY3BzLmxldHNlbmNyeXB0Lm9yZzCBqwYIKwYBBQUHAgIwgZ4MgZtUaGlzIENl
cnRpZmljYXRlIG1heSBvbmx5IGJlIHJlbGllZCB1cG9uIGJ5IFJlbHlpbmcgUGFy
dGllcyBhbmQgb25seSBpbiBhY2NvcmRhbmNlIHdpdGggdGhlIENlcnRpZmljYXRl
IFBvbGljeSBmb3VuZCBhdCBodHRwczovL2xldHNlbmNyeXB0Lm9yZy9yZXBvc2l0
b3J5LzANBgkqhkiG9w0BAQsFAAOCAQEADyyX7rcEJqJalNfQzVVGcLNAct5L2pHT
hCO1i98FNbV1fciY3dKw92pXRsqJ2ZgNmSNvBkZ352ieDpDqygnJFymI2n8/ob3w
00I1ywS+8zvthGR+bPr5sIs1NNYDSBcK8p5GETD2TEvqkGqc29XC2GsMuBQqU9o1
jrVt9Pjji8dX9kLwbqHKB0jNlkf92UBmbFifBik66Lpa3VQ8pCYVkTnlpNgCTkDD
JhSwTUtrHdm6nBg0KA2ecgPvZouijgXnTIkSBrf62U5VlnVULXz13I+0zqtq4zwT
h7kD+XcN2TVdClibFFh5v46RjBlhGibSfh2zMLhHLakaQjcwLT+b5w==
-----END CERTIFICATE-----";
// Domain of the signing entity (i.e. the email domain)
// This field is mandatory
$DKIM_d='qflash.pl' ;  

// Default identity 
// Optional (can be left commented out), defaults to no user @$DKIM_d
//$DKIM_i='@example.com' ; 

// Selector, defines where the public key is stored in the DNS
//    $DKIM_s._domainkey.$DKIM_d
// Mandatory
$DKIM_s='all' ;

?>