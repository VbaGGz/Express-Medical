function requireLogin(req, res, next) {
  if (!req.session || !req.session.user) {
    return res.redirect('/?error=notloggedin');
  }
  next();
}

function requireRole(level) {
  return (req, res, next) => {
    if (!req.session || !req.session.user) {
      return res.redirect('/?error=notloggedin');
    }
    const userLevel = req.session.user.P_Level;
    if (userLevel !== level) {
      const dest = { 1: '/employee/homepage', 2: '/hr/homepage', 3: '/admin/homepage' };
      return res.redirect(dest[userLevel] || '/');
    }
    next();
  };
}

module.exports = { requireLogin, requireRole };
