const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"login":{"uri":"login","methods":["GET","HEAD"]},"post.login":{"uri":"login","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"post.register":{"uri":"register","methods":["POST"]},"home":{"uri":"\/","methods":["GET","HEAD"]},"profile":{"uri":"user\/profile\/edit","methods":["GET","HEAD"]},"post.profile":{"uri":"user\/profile\/edit","methods":["POST"]},"logout":{"uri":"logout","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
