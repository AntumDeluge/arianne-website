<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>
<XML_DIZ_INFO>
	<MASTER_PAD_VERSION_INFO>
		<MASTER_PAD_VERSION>3.10</MASTER_PAD_VERSION>
		<MASTER_PAD_EDITOR>Online PAD Generator 1.33</MASTER_PAD_EDITOR>
		<MASTER_PAD_INFO>Portable Application Description, or PAD for short, is a data set that is used by shareware authors to disseminate information to anyone interested in their software products. To find out more go to http://www.asp-shareware.org/pad</MASTER_PAD_INFO>
	</MASTER_PAD_VERSION_INFO>
	<Company_Info>
		<Company_Name>Arianne Project</Company_Name>
		<Address_1 />
		<Address_2 />
		<City_Town />
		<State_Province />
		<Zip_Postal_Code />
		<Country />
		<Company_WebSite_URL>http://arianne.sf.net</Company_WebSite_URL>
		<Contact_Info>
			<Author_First_Name />
			<Author_Last_Name />
			<Author_Email>arianne-general@lists.sourceforge.net</Author_Email>
			<Contact_First_Name />
			<Contact_Last_Name />
			<Contact_Email />
		</Contact_Info>
		<Support_Info>
			<Sales_Email />
			<Support_Email />
			<General_Email />
			<Sales_Phone />
			<Support_Phone />
			<General_Phone />
			<Fax_Phone />
		</Support_Info>
	</Company_Info>
	<Program_Info>
		<Program_Name>Stendhal</Program_Name>
		<Program_Version><?php
		$file = dirname(__FILE__).'/../stendhal.version';
		$version = trim(file_get_contents(file));
		$modified = filemtime($file);
		echo htmlspecialchars($version);
		?></Program_Version>
		<Program_Release_Month><?php echo date('m', $modified)?></Program_Release_Month>
		<Program_Release_Day><?php echo date('d', $modified)?></Program_Release_Day>
		<Program_Release_Year><?php echo date('Y', $modified)?></Program_Release_Year>
		<Program_Cost_Dollars />
		<Program_Cost_Other_Code />
		<Program_Cost_Other />
		<Program_Type>Freeware</Program_Type>
		<Program_Release_Status />
		<Program_Install_Support />
		<Program_OS_Support>Linux,Linux Gnome,Linux GPL,Linux Open Source,Mac OS X,Unix,Win2000,Win7 x32,Win7 x64,Win98,WinOther,WinVista,WinVista x64,WinXP</Program_OS_Support>
		<Program_Language>English</Program_Language>
		<Program_Change_Info />
		<Program_Specific_Category>Games</Program_Specific_Category>
		<Program_Category_Class>Games &amp; Entertainment::Adventure &amp; Roleplay</Program_Category_Class>
		<Program_Categories />
		<Program_System_Requirements />
		<File_Info>
			<File_Size_Bytes />
			<File_Size_K />
			<File_Size_MB />
		</File_Info>
		<Expire_Info>
			<Has_Expire_Info>N</Has_Expire_Info>
			<Expire_Count />
			<Expire_Based_On />
			<Expire_Other_Info />
			<Expire_Month />
			<Expire_Day />
			<Expire_Year />
		</Expire_Info>
	</Program_Info>
	<Program_Descriptions>
		<English>
			<Keywords>MMORPG, RPG, game, Stendhal, Adventure, role-playing</Keywords>
			<Char_Desc_45 />
			<Char_Desc_80 />
			<Char_Desc_250>Stendhal is a fun friendly and free multiplayer online adventure game. Start playing, get hooked... Get the source code, and add your own ideas...</Char_Desc_250>
			<Char_Desc_450 />
			<Char_Desc_2000 />
		</English>
	</Program_Descriptions>
	<Web_Info>
		<Application_URLs>
			<Application_Info_URL>http://arianne.sourceforge.net/game/stendhal.html</Application_Info_URL>
			<Application_Order_URL />
			<Application_Screenshot_URL>http://arianne.sourceforge.net/screens/stendhal/raid20110105.jpg</Application_Screenshot_URL>
			<Application_Icon_URL>https://stendhalgame.org/favicon.ico</Application_Icon_URL>
			<Application_XML_File_URL>http://arianne.sourceforge.net/stendhal/pad_file.xml</Application_XML_File_URL>
		</Application_URLs>
		<Download_URLs>
			<Primary_Download_URL>http://arianne.sourceforge.net/download/stendhal.zip</Primary_Download_URL>
			<Secondary_Download_URL>https://sourceforge.net/projects/arianne/files/stendhal</Secondary_Download_URL>
			<Additional_Download_URL_1 />
			<Additional_Download_URL_2 />
		</Download_URLs>
	</Web_Info>
	<Permissions>
		<Distribution_Permissions>GPL</Distribution_Permissions>
		<EULA />
	</Permissions>
</XML_DIZ_INFO>