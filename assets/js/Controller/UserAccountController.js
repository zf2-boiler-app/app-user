var UserControllerUserAccount = {
	Extends: Controller,
	
	/**
	 * @return UserControllerUserAccount
	 */
	changeUserAvatar : function(){
		new Modal.Popup({
			'title':this.translate('change_avatar'),
			'url':this.url('User/Account/change-avatar')
		});
		return this;
	},
	
	/**
	 * @param string sAvatar
	 * @return UserControllerUserAccount
	 */
	setUserAvatar : function(sAvatar){
		var eUserAvatar = document.id('user_avatar');
		if(eUserAvatar == null)throw 'User avatar image is undefined';
		eUserAvatar.set('src','data:image/png;base64,'+sAvatar);
		return this;
	},
	
	/**
	 * @return UserControllerUserAccount
	 */
	changeUserDisplayName : function(){
		new Modal.Popup({
			'title':this.translate('change_display_name'),
			'url':this.url('User/Account/ChangeDisplayName')
		});
		return this;
	},
	
	/**
	 * @param string sDisplayName
	 * @return UserControllerUserAccount
	 */
	setUserDisplayName : function(sDisplayName){
		var eUserDisplayName = document.id('user_display_name');
		if(eUserDisplayName == null)throw 'User display name element is undefined';
		eUserDisplayName.set('html',sDisplayName);
		return this;
	}
};
UserControllerUserAccount = new Class(UserControllerUserAccount);