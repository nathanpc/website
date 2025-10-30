<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Best Wi-Fi router solution for retro computers</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Best Wi-Fi router solution for retro computers</h2>
		<div id="published-date">2025-04-21 - <a href="gopher://nathancampos.me/0/phlog/2025-04-21_best-retro-wifi/post.txt">Also available on Gopher</a></div>
	</div>

<pre id="plain-text">If you're into retro computers, you will eventually want to connect them to your
local network to browse The Old Internet [<a href="https://theoldnet.com">1</a>] or simply to easily transfer files
between your modern machines, or a NAS, and your retro rig without the hassle of
removable media.

If the retro device that you're connecting to your network has an a wired RJ-45
port for Ethernet, then it's as simple as connecting the machine to your switch
and you're good to go, but if your machine is quite old and the only available
option is Wi-Fi, such is the case with Palmtops or handheld gaming devices, you
will quickly realize that these devices either don't support the newer wireless
standards, requiring 802.11g [<a href="https://en.wikipedia.org/wiki/IEEE_802.11g-2003">2</a>] or 802.11b [<a href="https://en.wikipedia.org/wiki/IEEE_802.11b-1999">3</a>], or they can only authenticate
using WEP [<a href="https://en.wikipedia.org/wiki/Wired_Equivalent_Privacy">4</a>] or the first generation of WPA [<a href="https://en.wikipedia.org/wiki/Wi-Fi_Protected_Access">5</a>], both of which are deprecated
and most wireless routers, including smartphone hotspots, won't even allow you
to select as an option for protection.

These limitations greatly reduce the enjoyment that you can get out of some of
your old devices, and for years I had an old access point configured with WEP
that I turned on whenever I wanted to play with a device that needed WiFi, which
was always cumbersome, since I had to plug it in and remember to plug it back
off when I was finished, since leaving such a device on would be a security
nightmare for my home network, so I always wanted to find a solution to this
problem, and I think I found the perfect one.

For ~25€ on Amazon.es [<a href="https://www.amazon.es/dp/B00TQEX8BO">6</a>] you can purchase a TP-Link Nano TL-WR802N [<a href="https://www.tp-link.com/us/home-networking/wifi-router/tl-wr802n/">7</a>] wireless
router. A tiny square access point that is fully supported by OpenWRT [<a href="https://openwrt.org/toh/tp-link/tl-wr802n_v4">8</a>] (even
the latest revision of the hardware, v4 as of 2025-04-21), meaning we can unlock
its full potential and have proper control over this tiny device.

My goal for the perfect retro wireless router was something that I could leave
turned on 24/7, supported my old devices, including the ones that require
802.11b, required no authentication, since I had issues with WEP in the past,
and blocked all non-authorized devices. All tasks that can be easily
accomplished with OpenWRT and a MAC address allowlist.

The first step on this journey was to flash OpenWRT onto the router, which
wasn't a simple task, since the only way to do it was to netboot it using
TFTP [<a href="https://en.wikipedia.org/wiki/Trivial_File_Transfer_Protocol">9</a>], a method that I've always had mixed results with in the past. The
instructions found in the OpenWRT wiki [<a href="https://openwrt.org/toh/tp-link/tl-wr802n_v4#installation">10</a>] were helpful, but I wasn't able to
get it to work with the default static IP described there, so instead I used the
parameters found on a Reddit comment [<a href="https://old.reddit.com/r/openwrt/comments/m8le8v/openwrt_tplink_tlwr802n_need_installation_help/grtzg5i/">11</a>]. Here are the settings that worked:

<a href="http://nathancampos.me/log/2025-04-21_best-retro-wifi/network-settings.png"><img src="http://nathancampos.me/log/2025-04-21_best-retro-wifi/network-settings.png_compat.gif"></a>

I was on a Mac, so I had to use PumpKIN [<a href="https://kin.klever.net/pumpkin/">12</a>] as my TFTP server which, despite my
past experiences with TFTP, worked flawlessly, and I was able to flash the
router after many tries with different network settings.

PumpKIN TFTP server settings:
<a href="http://nathancampos.me/log/2025-04-21_best-retro-wifi/pumpkin-settings.png"><img src="http://nathancampos.me/log/2025-04-21_best-retro-wifi/pumpkin-settings.png_compat.gif"></a>

PumpKIN serving the OpenWRT firmware:
<a href="http://nathancampos.me/log/2025-04-21_best-retro-wifi/pumpkin-flashing.png"><img src="http://nathancampos.me/log/2025-04-21_best-retro-wifi/pumpkin-flashing.png_compat.gif"></a>

After the initial configuration of OpenWRT, setting it up to use my DHCP server
and other things specific to my network, the only thing left to do was to setup
the access point so that my old devices could freely connect to it. The
following settings were used for this purpose:

<a href="http://nathancampos.me/log/2025-04-21_best-retro-wifi/openwrt-ssid.png"><img src="http://nathancampos.me/log/2025-04-21_best-retro-wifi/openwrt-ssid.png_compat.gif"></a>

After enabling the network, the last thing to do was to go to the MAC-Filter tab
and add the MAC addresses of all my old devices, ensuring that only the devices
listed on that section would be able to connect to the access point, without any
password or security required, ensuring the maximum amount of compatibility
while still keeping my home network secure.

I've been using this setup for the past week and it has worked flawlessly so
far. All my retro devices connect instantly to it. The only aspect that I still
need to improve on it is a way to easily add MAC addresses to the allowlist
without having to manually look them up on the device and enter it using the web
interface. Maybe I'll eventually write a script that gets the OpenWRT access
logs and adds the last device that tried to connect to it to the allowlist, or
something like this. If I ever get around to developing a solution for this I'll
surely post about it.

[1]:  <a href="https://theoldnet.com">https://theoldnet.com</a>
[2]:  <a href="https://en.wikipedia.org/wiki/IEEE_802.11g-2003">https://en.wikipedia.org/wiki/IEEE_802.11g-2003</a>
[3]:  <a href="https://en.wikipedia.org/wiki/IEEE_802.11b-1999">https://en.wikipedia.org/wiki/IEEE_802.11b-1999</a>
[4]:  <a href="https://en.wikipedia.org/wiki/Wired_Equivalent_Privacy">https://en.wikipedia.org/wiki/Wired_Equivalent_Privacy</a>
[5]:  <a href="https://en.wikipedia.org/wiki/Wi-Fi_Protected_Access">https://en.wikipedia.org/wiki/Wi-Fi_Protected_Access</a>
[6]:  <a href="https://www.amazon.es/dp/B00TQEX8BO">https://www.amazon.es/dp/B00TQEX8BO</a>
[7]:  <a href="https://www.tp-link.com/us/home-networking/wifi-router/tl-wr802n/">https://www.tp-link.com/us/home-networking/wifi-router/tl-wr802n/</a>
[8]:  <a href="https://openwrt.org/toh/tp-link/tl-wr802n_v4">https://openwrt.org/toh/tp-link/tl-wr802n_v4</a>
[9]:  <a href="https://en.wikipedia.org/wiki/Trivial_File_Transfer_Protocol">https://en.wikipedia.org/wiki/Trivial_File_Transfer_Protocol</a>
[10]: <a href="https://openwrt.org/toh/tp-link/tl-wr802n_v4#installation">https://openwrt.org/toh/tp-link/tl-wr802n_v4#installation</a>
[11]: <a href="https://old.reddit.com/r/openwrt/comments/m8le8v/openwrt_tplink_tlwr802n_need_installation_help/grtzg5i/">https://old.reddit.com/r/openwrt/comments/m8le8v/openwrt_tplink_tlwr802n_need_installation_help/grtzg5i/</a>
[12]: <a href="https://kin.klever.net/pumpkin/">https://kin.klever.net/pumpkin/</a>
</pre>

	<?php include_template('footer'); ?>
</body>
</html>
