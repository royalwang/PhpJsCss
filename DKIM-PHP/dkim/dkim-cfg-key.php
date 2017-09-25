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

$open_SSL_priv="-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDWOf+Qf+yJvU+F2JNxlaKCiU5EkAL+URj1yM9Xbq6zMXZVJuJz
+tJ9p6wLGmciTTYmlCfw89nbkydjTzQQl0IA634XpjDiSU2FQ8dGYQjAI3B3S+lk
iNK3nArJEqaeL5y8PHQ8SpFMDlJCX/CAo5JCxogLOn7lcKKpXLyRZiyEBwIDAQAB
AoGBAMksnfqspwySYuNmhs/bnUjIeF+afbUlozLs6QlKP3S3tlAwu+f+Wzz1AHNM
0B0+NOP1raxw0t2ISyzPbC1IXgmWJB0x5vmU5lZ2s3fFENMizfypQcO69r5n8+XG
AvhOUj6vYcz2669iX6opWbYW4TJ5u7phjdxAYfGXJ0xo+9dBAkEA+5jVzrKYroG4
5ggJ+5DfUQj+SJPIBuKR9sBHsB+GuX2uBKS2o0VU198XahkHCMLYvG2ghlWQpwZA
NsRbi5bWdQJBANn5vfCiJUiJIWa5SSOk1ai0FB7LZCZh+2OowV5db5LUKVT+F4Ds
94Uv7e0S4HYkVNz0KhdTb4ywM8z7sIuEeQsCQDR+nQ21gdnXQybrwnl0rsOPps6p
1vBo0Z+0WsDKsyd8q5RYcar7SkqIR7BhbHBNhz85eGbO75GJ4lgK/DbR0AkCQEZZ
GprxybSaRURg4iD1ztrum1vA6qaUksx8J0QsRZkOjfRXOQCr+cprSI9tuzGF0jmp
N3hlvieaqm0qgbTVYTcCQQCTs+HDtbPUQb/isIT1fFjIkf9bSEVt38eI7VOp38/w
68dS+RXrtHNp11CaiPSj949FYr4gdF6a5xlNQqCtHE7e
-----END RSA PRIVATE KEY-----";

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